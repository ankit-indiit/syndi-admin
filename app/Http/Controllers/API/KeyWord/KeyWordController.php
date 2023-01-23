<?php

namespace App\Http\Controllers\API\KeyWord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\KeyWord;
use Carbon\Carbon;

class KeyWordController extends Controller
{   
    public function index()
    {
        $keyWords = KeyWord::select('id', 'term', 'status')->where('user_id', Auth::id())->get();
        return response()->json([
            'status' => count($keyWords) > 0 ? true : false,
            'data' => $keyWords,
        ]);
    }
   
    public function create()
    {
        
    }
   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'term' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }
        $request['user_id'] = Auth::id();
        $request['status'] = '1';
        $keyWords = KeyWord::create($request->all());
        return response()->json([
            'status' => true,
            'id' => $keyWords->id,
            'term' => $keyWords->term,
            'status' => $keyWords->status,
            'replay_count' => 0,            
        ]);        
    }
    
    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {       
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }
        if (KeyWord::where('id', $id)->exists()) {
            KeyWord::where('id', $id)->update([
                'status' => $request->status
            ]);
            $status = true;
            $message =  $request->status == 1 ? 'Enabled' : 'Disable';
        } else {
            $status = false;
            $message = 'Key word does not exist!';
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }

    public function destroy($id)
    {
        $keyWords = KeyWord::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Key word has been deleted!',
        ]);
    }
}
