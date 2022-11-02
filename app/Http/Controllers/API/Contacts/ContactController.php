<?php

namespace App\Http\Controllers\API\Contacts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Collection;

use App\Models\User;
use App\Models\Contact;
use App\Models\Msg;
use App\Models\Group;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts_query = Contact::where('user_id', Auth::user()->id)
                            ->where('status', 1)
                            ->select('id', 'phone_number', 'first_name', 'last_name', 'email', 'note', 'group_ids', 'created_at')
                            ->get();
        $contacts = $this->getContacts($contacts_query);

        $messages = Msg::all();
        $connected_phones = $this->getConnectedPhones($messages);
        
        $data = array_merge($contacts, $connected_phones);
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
        $csvFile = $request->contact_file;
        // $csvFile = $request->file('contact_file');

        if (is_null($csvFile)) {
            $phone_number = $request->phone_number;
            $first_name = $request->first_name;
            $last_name = $request->last_name;
            $email = $request->email;
            $note = $request->note;
            $group_ids = $request->group_ids;

            $query = Contact::where('user_id', Auth::user()->id)->where('phone_number', $phone_number)->first();
            if (is_null($query)) {
                $contact = Contact::Create([
                    'user_id' => Auth::user()->id,
                    'phone_number' => $phone_number,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'note' => $note,
                    'group_ids' => $group_ids
                ]);
            } else {
                return response()->json([
                    'status' => 406, // not acceptable
                    'message' => 'The contact is already exist.',
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'New contact created successfully.',
                'data' => [
                    'contact' => $contact,
                ]
            ]);
        } else {
            $this->validate(request(), [
                'contact_file' => ['required',function ($attribute, $value, $fail) {
                    if (!in_array($value->getClientOriginalExtension(), ['csv'])) {
                        $fail('Incorrect :attribute type choose. It must be csv file type.');
                    }
                }]
            ]);
            $data = $this->csvToArray($csvFile);

            foreach ($data as $key => $value) {
                $phone_number = $value['Phone Number'];
                $query = Contact::where('user_id', Auth::user()->id)->where('phone_number', $phone_number)->first();

                if (is_null($query)) {
                    $contact = Contact::Create([
                        'user_id' => Auth::user()->id,
                        'phone_number' => $phone_number,
                        'first_name' => $value['First Name'],
                        'last_name' => $value['Last Name'],
                        'email' => $value['Email'],
                        'note' => $value['Note'],
                    ]);
                }
            }
            return response()->json([
                'status' => 200,
                'message' => 'New contacts created successfully from CSV file.',
                'data' => $data
            ]);
        }
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


    // Read CSV file and get Array
    protected function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    // Get Contact List with Group name
    protected function getContacts($contacts_query)
    {
        $contacts = array();
        foreach ($contacts_query as $key => $contact)
        {
            $sub_arr = [];
            $sub_arr['id'] = $contact->id;
            $sub_arr['phone_number'] = $contact->phone_number;
            $sub_arr['first_name'] = $contact->first_name;
            $sub_arr['last_name'] = $contact->last_name;
            $sub_arr['email'] = $contact->email;
            $sub_arr['note'] = $contact->note;
            $sub_arr['group_names'] = '';
            $sub_arr['source'] = 'Manually Added';
            $sub_arr['created_at'] = $contact->created_at;

            $groups = Group::where('user_id', Auth::user()->id)->where('status', 1)->get();
            $group_ids = array_map('intval', explode(',', $contact->group_ids));
            foreach ($groups as $key => $group)
            {
                if(in_array($group->id, $group_ids))
                {
                    if ($sub_arr['group_names'] == '') {
                        $sub_arr['group_names'] = $group->name;
                    } else {
                        $sub_arr['group_names'] = $sub_arr['group_names'] . ', ' . $group->name;
                    }
                }
            }
            array_push($contacts, $sub_arr);
        }
        return $contacts;
    }
    // Get Connected Phone number List
    protected function getConnectedPhones($messages)
    {
        $phones = array();
        $connected_phones = array();
        foreach ($messages as $key => $value)
        {
            $sub_arr = [];
            $sub_arr['phone_number'] = '';
            $sub_arr['first_name'] = '';
            $sub_arr['last_name'] = '';
            $sub_arr['email'] = '';
            $sub_arr['note'] = '';
            $sub_arr['group_names'] = '';
            $sub_arr['source'] = 'Outbound';
            if(!in_array($value->sender_phone, $phones)) {
                $sub_arr['phone_number'] = $value->sender_phone;
                $sub_arr['created_at'] = $value->created_at;
                array_push($phones, $value->sender_phone);
                array_push($connected_phones, $sub_arr);
            }
            if(!in_array($value->receiver_phone, $phones)) {
                $sub_arr['phone_number'] = $value->receiver_phone;
                $sub_arr['created_at'] = $value->created_at;
                array_push($phones, $value->receiver_phone);
                array_push($connected_phones, $sub_arr);
            }
        }
        return $connected_phones;
    }
}
