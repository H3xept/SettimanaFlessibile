<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stripe extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
