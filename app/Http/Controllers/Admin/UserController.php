<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
Use App\Models\User;
use DataTables;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('email', '!=', 'admin@gmail.com')->orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function (User $user) {
                    return '<img class="table_img" src="'.$user->image.'" alt="">';
                })
                ->editColumn('name', function (User $user) {
                    return $user->full_name;
                })
                ->editColumn('email', function (User $user) {
                    return $user->email;
                })
                ->editColumn('status', function (User $user) {
                    return $user->status_badge;
                })
                ->addColumn('action', function ($row) {

                    return '<a href="'.route('user.show', $row->id).'" class="btn btn-xs btn-info"><i class="mdi mdi-eye"></i></a><a href="'.route('user.edit', $row->id).'" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a><a href="javascript: void(0);" class="btn btn-xs btn-danger" id="deleteUser" data-id="'.$row->id.'"><i class="mdi mdi-trash-can"></i></a>';
                })
                ->rawColumns(['action', 'image', 'status'])
                ->make(true);
        }
        return view('admin.users.index');
    }   

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {       
        DB::beginTransaction();
        
        try {

            $request['password'] = Hash::make($request->confirm_password);
            $request['dpassword'] = $request->confirm_password;          
            if ($request->file('user_image')) {
                $image = $request->file('user_image');       
                $imageName = $image->getClientOriginalName();
                $destinationPath = public_path('/assets/admin/images/users');
                $image->move($destinationPath, $imageName);
                $request['image'] = $imageName;     
                User::create($request->except('first_name', 'last_name', 'user_image'));
            } else {
                User::create($request->except('first_name', 'last_name', 'user_image'));
            }

            DB::commit();
            
            return response()->json([
                'status' => true,
                'message' => 'User has been created!',            
            ]);

        } catch (\Exception $e) {
            $message['message'] = $e->getMessage();
            DB::rollback();
            $message['erro'] = 101;
            return response()->json($message, 200);
        } 
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        
        try {
            
            if ($request->type == 'image') {
                if ($request->file('user_img')) {
                    $image = $request->file('user_img');       
                    $imageName = $image->getClientOriginalName();
                    $destinationPath = public_path('/assets/admin/images/users');
                    $image->move($destinationPath, $imageName);
                    User::where('id', $id)->update([
                        'image' => $imageName
                    ]);
                }                 
            }

            if ($request->type == 'detail') {
                $request['dpassword'] = 'NULL';           
                if (isset($request->password) && isset($request->confirm_password)) {
                    $request['password'] = Hash::make($request->confirm_password);
                    $request['dpassword'] = $request->confirm_password;
                    User::where('id', $id)->update($request->except('_token', 'type', '_method', 'first_name', 'last_name', 'user_image', 'confirm_password'));
                } else {
                    User::where('id', $id)->update($request->except('_token', '_method', 'type', 'first_name', 'last_name', 'password', 'user_image', 'confirm_password'));
                }                
            }


            DB::commit();
            
            return redirect()->back()->with('success', 'User '.$request->type.' has been updated!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());            
        } 
    }   

    public function destroy($id)
    {
        if (User::where('id', $id)->delete()) {
            $status = true;
            $message = 'User has been deleted!';
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
