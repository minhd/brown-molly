<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected static $availableStatuses = ["PENDING", "COMPLETED"];
    protected static $defaultStatus = "PENDING";

    protected $fillable = ["name", "status", "user_id"];
    protected $attributes = [ "status"=>"PENDING" ];

    public static function getDefaultStatus() {
        return self::$defaultStatus;
    }

    function user(){
    	return $this->belongsTo('App\User');
    }
}


