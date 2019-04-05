<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'user_id'
    ];

    public function Todos() {
        return $this->hasMany('App\Todo');
    }

    public function User() {
        return $this->belongsTo('App\User');
    }
}
