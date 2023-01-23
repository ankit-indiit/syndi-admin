<?php

namespace App\Http\Controllers\API\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;

class NotificationController extends Controller
{    
    public function unreadNotification()
    {
        $user = Auth::user();
        $user->unreadNotifications()->update(['read_at' => now()]);
        $count = DB::table('notifications')
            ->where('notifiable_id', $user->id)
            ->where('read_at', '=', null)
            ->pluck('id')
            ->toArray();        
        $notifications = DB::table('notifications')
            ->where('notifiable_id', $user->id)
            // ->where('read_at', NULL)
            ->take(4)
            ->get();
        foreach ($notifications as $notification) {
            $user = json_decode($notification->data);
            $userName = User::where('id', $user->user_id)->pluck('full_name')->first();
            $data[] = [
                'id' => $notification->id,
                'user_name' => $userName,
                'user_image' => "https://ui-avatars.com/api/?name=".$userName."",
                'message' => $user->message,
                'time' => Carbon::parse($notification->created_at)->diffForHumans(),                
            ];
        }
        return response()->json([
            'status' => true,
            'count' => count($count),
            'data' => @$data,
        ]);
    }

    public function allNotification()
    {
        $user = Auth::user();        
        $notifications = DB::table('notifications')
            ->where('notifiable_id', $user->id)
            ->paginate(10);
        foreach ($notifications as $notification) {
            $user = json_decode($notification->data);
            $userName = User::where('id', $user->user_id)->pluck('full_name')->first();
            $data[] = [
                'id' => $notification->id,
                'user_name' => $userName,
                'user_image' => "https://ui-avatars.com/api/?name=".$userName."",
                'message' => $user->message,
                'time' => Carbon::parse($notification->created_at)->diffForHumans(),
            ];
        }
        return response()->json([
            'status' => true,
            'notifications' => $data,
        ]);
    }   
}
