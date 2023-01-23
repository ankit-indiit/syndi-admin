<?php
use App\Models\User;
use App\Models\Contact;
use App\Models\Group;

function getGroupMembersCount($id)
{
	return Contact::where('group_ids', $id)->count();
}

function getAllUsers()
{
	return User::pluck('full_name', 'id')->toArray();
}

function getGroupUser($id)
{
	return Contact::where('group_ids', $id)->pluck('user_id')->toArray();
}

function getGroupNameById($id)
{
	return Group::where('id', $id)->pluck('name')->first();
}

function getAllGroup()
{
	return Group::orderBy('id', 'DESC')->pluck('name', 'id')->toArray();
}