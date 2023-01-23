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
use App\Models\Group;
use App\Models\Contact;
use App\Models\User;
use DataTables;
use Carbon\Carbon;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Group::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()                
                ->editColumn('name', function (Group $group) {
                    return $group->name;
                })
                ->editColumn('contact', function (Group $group) {
                    return getGroupMembersCount($group->id);
                })
                ->editColumn('description', function (Group $group) {
                    return $group->description;
                })
                ->addColumn('action', function ($row) {
                    return '<a href="'.route('group.edit', $row->id).'" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a><a href="javascript: void(0);" class="btn btn-xs btn-danger" id="deleteGroup" data-id="'.$row->id.'"><i class="mdi mdi-trash-can"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.group.index');
    }    

    public function create()
    {
        return view('admin.group.create');
    }

    public function store(Request $request)
    {

        DB::beginTransaction();
        
        try {

            $group = Group::create($request->except('members'));
            foreach ($request->members as $member) {
                $user = User::findOrFail($member);                
                Contact::create([
                    'user_id' => $member,
                    'phone_number' => $user->phone,
                    'first_name' => @explode(' ', $user->full_name)[0],
                    'last_name' => @explode(' ', $user->full_name)[1],
                    'email' => $user->email,
                    'group_ids' => $group->id,
                    'status' => 1,
                    'block' => 0,
                ]);
            }

            DB::commit();
            
            return response()->json([
                'status' => true,
                'message' => 'Group has been created!',
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    public function show($id)
    {
        return view('admin.group.show');
    }

    public function edit($id)
    {
        $group = Group::findOrFail($id);
        return view('admin.group.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        
        try {

            Group::find($id)->update($request->except('members'));
            if (count($request->members) > 0) {
                Contact::where('group_ids', $id)->delete();
                foreach ($request->members as $member) {
                    $user = User::findOrFail($member);                
                    Contact::create([
                        'user_id' => $member,
                        'phone_number' => $user->phone,
                        'first_name' => @explode(' ', $user->full_name)[0],
                        'last_name' => @explode(' ', $user->full_name)[1],
                        'email' => $user->email,
                        'group_ids' => $id,
                        'status' => 1,
                        'block' => 0,
                    ]);
                }                
            }

            DB::commit();
            
            return response()->json([
                'status' => true,
                'message' => 'Group has been updated!',
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    public function destroy($id)
    {
        $group = Group::find($id)->delete();
        $group = Contact::where('group_ids', $id)->delete();
        if ($group) {
            $status = true;
            $message = 'Group has been deleted!';
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
