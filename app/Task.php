<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected static $availableStatuses = ["PENDING", "COMPLETED"];
    protected static $defaultStatus = "PENDING";

    protected $fillable = ["name", "list_id"];
    protected $attributes = [ "status"=>"PENDING" ];

    public static function getDefaultStatus() {
        return self::$defaultStatus;
    }

    public function save(array $options = []) {
        if (!$this->list_id) return false;

        // the list that this task belongs to
        $list = UserList::find($this->list_id);

        // then get the user that the list belongs to
        // because this task belongs to that user
        $this->user_id = $list->getUser()->id;

        // call parent save
        parent::save($options);
    }

    function user()
    {
    	return $this->belongsTo('App\User');
    }

    function lists()
    {
        return $this->belongsTo('App\UserList');
    }
}


