<?php

namespace App\Http\Controllers\API\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Exception;
use Image;

use App\Models\User;
use App\Models\Msg;
use App\Models\Img;

class ImageUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $phone = $request->phone;
        $request->validate([
            'phone' => 'required|string|max:20|exists:users',
        ]);
        $user_id = User::where('phone', $phone)->first()->id;

        $status = '';
        $message = '';
        $data = '';

        $image = $request->newImage;
        $imageName = '';
        $name = time();

        if(!is_null($image)) {
            $request->validate([
                'newImage' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:10000'
            ]);
            $imageName = $this->saveImage($name, $image);

            if ($imageName == 0) {
                $status = 'error';
                $message = 'Not valid file write permission.';
            } elseif ($imageName == 1) {
                $status = 'error';
                $message = 'mkdir() no such file or directory';
            } else {
                $status = 'success';
                $message = 'Successfully uploaded an image.';
                $data = Img::create([
                    'user_id' => $user_id,
                    'type' => 'library',
                    'img_url' => env('APP_API_SERVER_URL').'/assets/images/library/'.$imageName,
                ]);
            }
        } else {
            $status = 'warning';
            $message = 'Please select an image.';
        }
        
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
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
        if (Auth::check()) {

            $image = DB::table('imgs')->where('img_url', $id)->first();

            try {
                $this->deleteOldImage($inventory->image1);
            } catch (QueryException $e) {
                // $errorMsg = 'Something went wrong on the Storage side for inventory removal.';
                $errorMsg = '库存删除时出现存储问题。';
            }

            try {
                Inventory::destroy($id);
                // $successMsg = 'Successfully deleted the inventory selected.';
                // Session::flash('success', 'Successfully deleted the inventory selected.');

                $successMsg = '已成功删除所选的库存。';
                Session::flash('success', '已成功删除所选的库存。');

            } catch (QueryException $e) {
                // $errorMsg = 'Something went wrong on the Inventory Database side.';
                $errorMsg = '库存数据库出了点问题。';
            }

            return response()->json([
                'successMsg' => $successMsg,
                'warningMsg' => $warningMsg,
                'errorMsg' => $errorMsg
            ]);

        } else {
            return response()->json([
                // 'warningMsg' => 'Invalid user permission.'
                'warningMsg' => '用户权限无效。'
            ]);
        }
    }

    /**
     * Save Image function in Inventory page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function saveImage($name, $image)
    {
        try {
            $imageName = $name.'.'.$image->extension();
            $destinationPath = public_path('assets/images/library');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$imageName);

            return $imageName;
        } catch (QueryException $e) {   
            return 0;
        } catch (Exception $e) {
            return 1;
        }
    }

    /**
     * Display Library Image URLS for each user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLibraryImageUrl()
    {
        $user_id = Auth::user()->id;
        $lib_image_urls = array();
        $image_query = Img::where('user_id', $user_id)
                            ->where('type', 'library')
                            ->orderBy('created_at', 'DESC')
                            ->get();

        foreach ($image_query as $key => $image)
        {
            array_push($lib_image_urls, $image->img_url);
        }
        return response()->json($lib_image_urls);
    }

    /**
     * Display Free Image URLS From Admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFreeImageUrl()
    {
        $free_image_urls = array();
        $image_query = Img::where('type', 'free')
                            ->orderBy('created_at', 'DESC')
                            ->get();

        foreach ($image_query as $key => $image)
        {
            array_push($free_image_urls, $image->img_url);
        }
        return response()->json($free_image_urls);
    }
}
