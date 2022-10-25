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
                $data = ['img_url' => env('APP_API_SERVER_URL').'/assets/images/library/'.$imageName];
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
        //
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
}
