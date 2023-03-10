<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\User;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('units')->where('id', Auth::user()->id)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Current User Information',
            'data' => [
                'user' => $user,
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email = $request->email;
        $phone = $request->phone;

        if ($phone == '') {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
            $credentials = $request->only('email', 'password');
        }

        if ($email == '') {
            $request->validate([
                'phone' => 'required|string',
                'password' => 'required|string',
            ]);
            $credentials = $request->only('phone', 'password');
        }

        $attempt = Auth::attempt($credentials);
        if (!$attempt) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        $units = Auth::user()->units;
        $token = auth()->user()->createToken('API Token')->accessToken;
        // $auth_token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
        
        return response()->json([
            'status' => 'success',
            'message' => 'User logged in successfully',
            'data' => [
                'user' => $user,
                'token' => $token,
                // 'auth_token' => $auth_token,
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
            'data' => []
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'data' => [
                'token' => Auth::refresh(),
            ]
        ]);
    }

    /**
     * Reset password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {
        $email = $request->email;
        $phone = $request->phone;

        if (isset($email)) {
            $user = User::where('email', $email)->first();
        } else {
            $user = User::where('phone', $phone)->first();   
        }
        
        return response()->json([
            'status' => 'Success',
            'message' => 'In progressing',
            'data' => [
                'user' => $user,
            ]
        ]);
    }
}
