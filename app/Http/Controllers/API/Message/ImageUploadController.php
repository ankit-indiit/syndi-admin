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
        if ($id == "library") {
            $user_id = Auth::user()->id;
            $image_urls = array();
            $image_query = Img::where('user_id', $user_id)
                                ->where('type', $id)
                                ->where('msg_id', null)
                                ->orderBy('created_at', 'DESC')
                                ->get();
        } elseif ($id == "free") {
            $image_urls = array();
            $image_query = Img::where('type', $id)
                                ->orderBy('created_at', 'DESC')
                                ->get();
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Not valid url. Please input a correct url',
            ]);    
        }

        foreach ($image_query as $key => $image)
        {
            array_push($image_urls, $image->img_url);
        }
        return response()->json($image_urls);
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
     * @return \Illuminate\Http\Response
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Request $request)
    public function destroy(Request $request, $id)
    {
        $img_url = $request->img_url;
        $auth_validation = Auth::user()->phone == $id? true : false;

        if ($auth_validation)
        {
            // It should not be deleted the image from storage because many previous chatting histories uses the image public url.
            // try {
            //     $this->deleteImage($img_url);
            // } catch (QueryException $e) {
            //     $errorMsg = 'Something went wrong on the Storage side for Image removal.';
            // }
            try {
                $image = DB::table('imgs')
                            ->where('user_id', Auth::user()->id)
                            ->where('msg_id', null)
                            ->where('img_url', $img_url)->delete();
            } catch (QueryException $e) {
                $errorMsg = 'Something went wrong on the Img Database side.';
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Image deleted successfully',
                'data' => [
                    'img_url' => $img_url,
                ]
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized user'
            ]);
        }
    }

    /**
     * Save Image function in Library & Free Folder.
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
     * deleteImage function in Library and Free folder.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function deleteImage($path)
    {
        if (!is_null($path) && $path != '') {
            $sub_path = explode(env('APP_API_SERVER_URL'), $path)[1];
            File::delete(public_path($sub_path));
        }
    }

    /**
     * Public test deleteImage function in Library and Free folder.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteStorageImage()
    {
        $path = 'https://api.syndicatesms.com/assets/images/library/1666722918.png';
        $sub_path = explode(env('APP_API_SERVER_URL'), $path)[1];

        if (!is_null($sub_path) && $sub_path != '') {
            File::delete(public_path($sub_path));
        }
        return response()->json('ok');
    }
}
