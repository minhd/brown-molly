<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\UserList as UserList;
use Validator;

class UserListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lists = UserList::all();
        if ($request->input('with') == 'user') {
            $lists->load('user');
        } elseif ($request->input('with') == 'tasks') {
            $lists->load('tasks');
        }
        return $lists;
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        $list = new UserList([
            'name' => $request->input('name'),
            'user_id' => $request->input('user_id')
        ]);

        $list->save();
        return $list;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserList $list, Request $request)
    {
        if ($request->input('with') == 'user') {
            $list->load('user');
        }
        return $list;
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
    public function destroy(UserList $list)
    {
        return (string) $list->delete();
    }
}
