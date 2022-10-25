<?php

namespace App\Http\Controllers\API\Admin;

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
        $userRole = User::where('phone', $phone)->first()->role;

        $status = '';
        $message = '';
        $data = '';

        if ($userRole == 1)
        {
            $image = $request->newImage;
            $imageName = '';
            $name = time();

            if(!is_null($image)) {
                $request->validate([
                    'newImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000'
                ]);
                $imageName = $this->saveImage($name, $image, $userRole);

                if ($imageName == 0) {
                    $status = 'error';
                    $message = 'Not valid file write permission.';
                } elseif ($imageName == 1) {
                    $status = 'error';
                    $message = 'mkdir() no such file or directory';
                } else {
                    $img = Img::create([
                        'type' => 'free',
                        'img_url' => env('APP_API_SERVER_URL').'/assets/images/free/'.$imageName,
                    ]);
                    $status = 'success';
                    $message = 'Successfully uploaded an image.';
                    $data = $img;
                }
            } else {
                $status = 'warning';
                $message = 'Please select an image.';
            }
        } else {
            $status = 'warning';
            $message = 'Not valid user permission.';
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
    protected function saveImage($name, $image, $userRole)
    {
        try {
            $imageName = $name.'.'.$image->extension();
            $destinationPath = $userRole == 1? public_path('assets/images/free') : public_path('assets/images/library');
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
