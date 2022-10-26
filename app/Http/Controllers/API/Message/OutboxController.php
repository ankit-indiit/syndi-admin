<?php

namespace App\Http\Controllers\API\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

use App\Models\User;
use App\Models\Msg;
use App\Models\Msgerror;
use App\Models\Img;

use Carbon\Carbon;

class OutboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_phone = Auth::user()->phone;
        $messages = Msg::with(['img' => function ($query) {
                            $query->select('msg_id', 'img_url');
                        }])
                        ->where(function ($query) use ($user_phone) {
                            $query->where('sender_phone', '=', $user_phone);
                                    // ->orWhere('receiver_phone', '=', $user_phone);
                        })
                        ->where('schedule_at', null)
                        ->orderBy('created_at', 'DESC')
                        ->get()
                        ->groupBy('room_id');

        $last_message_array = $this->getLastMessages($messages);
        return response()->json($last_message_array);
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
        if ($id == "schedule") {
            $user_phone = Auth::user()->phone;
            $schedules = Msg::with(['img' => function ($query) {
                                $query->select('msg_id', 'img_url');
                            }])
                            ->where(function ($query) use ($user_phone) {
                                $query->where('sender_phone', '=', $user_phone);
                                        // ->orWhere('receiver_phone', '=', $user_phone);
                            })
                            ->where('schedule_at', '!=', null)
                            ->orderBy('created_at', 'DESC')
                            ->get()
                            ->groupBy(['message', 'schedule_at']);
            
            $schedule_arr = $this->getScheduleArray($schedules);
            return response()->json($schedule_arr);

        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Not valid url. Please input a correct url',
            ]);
        }
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

     /**
     * Messages List Array Get Function.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function getScheduleArray($schedules)
    {
        $schedule_arr = array();
        foreach ($schedules as $message => $schedule_q)
        {
            $sub_arr = [];
            $sub_arr['message'] = $message;
            $sub_arr['sender_phone'] = Auth::user()->phone;
            
            foreach ($schedule_q as $schedule_at => $phone_q)
            {
                $sub_arr['receiver_phones'] = [];
                $sub_arr['schedule_at'] = $schedule_at;
                
                foreach ($phone_q as $key => $value)
                {
                    array_push($sub_arr['receiver_phones'], $value->receiver_phone);
                    
                    $sub_arr['imageUrls'] = [];
                    foreach ($value->img as $img_key => $image)
                    {
                        array_push($sub_arr['imageUrls'], $image->img_url);
                    }
                }
            }
            array_push($schedule_arr, $sub_arr);
        }
        return $schedule_arr;
    }
}
