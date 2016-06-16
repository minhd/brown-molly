<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    protected $fillable = ['name', 'user_id'];

    function user() {
        return $this->belongsTo('App\User');
    }

    function getUser()
    {
    	return User::find($this->user_id);
    }

    function tasks() {
    	return $this->hasMany('App\Task', 'list_id');
    }
}
