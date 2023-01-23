<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.login');
    }   

    public function login(Request $request)
    {
        try {            
            $validated = Validator::make($request->all(), [
                'email' => 'required',                           
                'password' => 'required',                           
            ]);
            if ($validated->fails()) {
                return redirect()
                    ->back()
                    ->with('error', $validated->errors()
                    ->first())->withInput($request->all());               
            }

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->with('error', 'Please enter valid detail');
            }
            
        } catch (\Exception $e) {
            $message['message'] = $e->getMessage();
            $message['erro'] = 101;
            return response()->json($message, 200);
        } 
    }

    public function logOut()
    {
        Auth::logout();
        return redirect()->route('login');
    }    

    public function update(Request $request)
    {
        DB::beginTransaction();
        
        try {                  
            
            $admin = User::where('id', $request->id);
            if (isset($request->password) && isset($request->confirm_password)) {
                $request['password'] = Hash::make($request->confirm_password);
                $admin->update($request->except('_token', 'user_img', 'confirm_password'));
            } else {
                $admin->update($request->except('_token', 'user_img', 'password', 'confirm_password'));

            }
            
            DB::commit();
            
            return redirect()->back()->with('success', 'Admin has been updated!');

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        } 
    }

    public function image(Request $request)
    {       
        DB::beginTransaction();
        
        try {                  
            if ($request->hasFile('user_img')) {
                $image = $request->file('user_img');       
                $imageName = $image->getClientOriginalName();
                $destinationPath = public_path('/assets/admin/images/users');
                $image->move($destinationPath, $imageName);
                User::where('id', $request->id)->update([
                    'image' => $imageName
                ]);    
            }                      
            
            DB::commit();
            
            return response()->json([
                'status' => true,
                'message' => 'Image has been updated!',
                'image' => Auth::user()->image
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        } 
    }   
}
