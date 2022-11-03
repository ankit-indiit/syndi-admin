<?php

namespace App\Http\Controllers\API\Contacts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

use App\Models\User;
use App\Models\Group;
use App\Models\Contact;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::where('user_id', Auth::user()->id)->where('status', 1)->get();
        $data = $this->getGroups($groups);
        return response()->json($data);
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
        $name = $request->name;
        $description = $request->description;

        $request->validate([
            'name' => 'required|string|min:2|max:191|unique:groups',
        ]);
        $group = Group::Create([
            'user_id' => Auth::user()->id,
            'name' => $name,
            'description' => $description,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'New group created successfully.',
            'data' => [
                'group' => $group,
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
        $name = $request->name;
        $description = $request->description;
        $query = Group::where('id', '!=', $id)->where('name', $name)->first();

        if (is_null($query)) {
            $update = Group::where('id', $id)
                            ->update(array('name' => $name, 'description' => $description));    
            return response()->json([
                'status' => 200,
                'message' => 'Your changes were successfully updated.'
            ]);
        } else {
            return response()->json([
                'status' => 406,
                'message' => 'The group name is already exist.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group_ids = array_map('intval', explode(',', $id));
        try {
            foreach ($group_ids as $key => $group_id) {
                Group::where('user_id', Auth::user()->id)->where('id', $group_id)->delete();
                
                $contacts = Contact::where('user_id', Auth::user()->id)
                        ->where('group_ids', 'LIKE', '%'.$group_id.'%')
                        ->where('status', 1)
                        ->get();
                foreach ($contacts as $key => $contact) {
                    
                    $prev_ids = $contact->group_ids;
                    $new_ids = str_replace(','.$group_id, '', $prev_ids);
                    $new_ids = str_replace($group_id.',', '', $new_ids);

                    $update = Contact::where('id', $contact->id)
                                ->update(array('group_ids' => $new_ids));    
                }
            }
            return response()->json([
                'status' => 200,
                'message' => 'The selected groups are deleted successfully.'
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong. Please contact administrator.'
            ]);
        }
    }

    /**
     * Group List Array Get Function.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function getGroups($groups)
    {
        $groups_array = array();
        foreach ($groups as $key => $group)
        {
            $sub_arr = [];
            $sub_arr['id'] = $group->id;
            $sub_arr['name'] = $group->name;
            $sub_arr['description'] = $group->description;
            $sub_arr['contact_num'] = 0;

            $contacts = Contact::where('user_id', Auth::user()->id)->where('status', 1)->get();
            foreach ($contacts as $key => $contact)
            {
                $group_ids = array_map('intval', explode(',', $contact->group_ids));

                if(in_array($group->id, $group_ids))
                {
                    $sub_arr['contact_num'] += 1;
                }
            }
            array_push($groups_array, $sub_arr);
        }
        return $groups_array;
    }
}
