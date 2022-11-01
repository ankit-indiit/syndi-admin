<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Msg;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_phone = Auth::user()->phone;
        $unread_msg_num = Msg::with(['img' => function ($query) {
                            $query->select('msg_id', 'img_url');
                        }])
                        ->where('receiver_phone', $user_phone)
                        ->where('read', 0)
                        ->get()
                        ->count();
        
        $sent_msg_num = Msg::with(['img' => function ($query) {
                            $query->select('msg_id', 'img_url');
                        }])
                        ->where('sender_phone', $user_phone)
                        ->get()
                        ->count();

        return response()->json([
            'status' => 200,
            'data' => [
                'unread_msg_num' => $unread_msg_num,
                'sent_msg_num' => $sent_msg_num,
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
        //
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
        //
    }
}
