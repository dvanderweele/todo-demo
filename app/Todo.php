<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'project_id', 'user_id', 'description', 'completed'
    ];

    public function Project() {
        return $this->belongsTo('App\Project');
    }

    public function User() {
        return $this->belongsTo('App\User');
    }
}
