<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use Carbon\Carbon;
use DataTables;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contact::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()                
                ->editColumn('phone_number', function (Contact $contact) {
                    return $contact->phone_number;
                })
                ->editColumn('name', function (Contact $contact) {
                    return $contact->first_name.' '.$contact->last_name;
                })
                ->editColumn('email', function (Contact $contact) {
                    return $contact->email;
                })
                ->editColumn('group', function (Contact $contact) {
                    return getGroupNameById($contact->group_ids);
                })
                ->editColumn('source', function (Contact $contact) {
                    return '';
                })
                ->editColumn('added', function (Contact $contact) {
                    return $contact->created_at;
                })
                ->addColumn('action', function ($row) {

                    return '<a href="'.route('contact.edit', $row->id).'" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a><a href="javascript: void(0);" class="btn btn-xs btn-danger" id="deleteContact" data-id="'.$row->id.'"><i class="mdi mdi-trash-can"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.contact.index');
    }    

    public function create()
    {
        return view('admin.contact.create');
    }

    public function store(Request $request)
    {       
        DB::beginTransaction();
        
        try {

            Contact::create($request->all());                

            DB::commit();
            
            return response()->json([
                'status' => true,
                'message' => 'Contact has been created!',
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
         DB::beginTransaction();
        
        try {

            Contact::find($id)->update($request->all());                

            DB::commit();
            
            return response()->json([
                'status' => true,
                'message' => 'Contact has been updated!',
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    public function destroy($id)
    {       
        if (Contact::where('id', $id)->delete()) {
            $status = true;
            $message = 'Contact has been deleted!';
        } else {
            $status = false;
            $message = 'Please try again!';
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]); 
    }

}
