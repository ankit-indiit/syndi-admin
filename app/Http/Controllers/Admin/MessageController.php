<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function index()
    {
        return view('admin.message.index');
    }    

    public function create()
    {
        return view('admin.message.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('admin.message.show');
    }

    public function edit($id)
    {
        return view('admin.message.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        // 
    }

}
