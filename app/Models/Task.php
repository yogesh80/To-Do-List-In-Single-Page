<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable= [
        'task',
        'user_id'
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
