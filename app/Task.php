<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected static $availableStatuses = ["PENDING", "COMPLETED"];
    protected static $defaultStatus = "PENDING";

    protected $fillable = ["name", "status"];

    public static function getDefaultStatus() {
        return self::$defaultStatus;
    }
}


