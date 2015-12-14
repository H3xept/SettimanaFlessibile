<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function stripes()
    {
        return $this->hasMany('App\Stripe');
    }
}
