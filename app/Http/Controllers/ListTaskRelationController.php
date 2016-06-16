<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\UserList;
use App\Task;

class ListTaskRelationController extends Controller
{
    public function index(UserList $list)
    {
    	$list->load('user');
    	$list->load('tasks');
    	return $list;
    }
}
