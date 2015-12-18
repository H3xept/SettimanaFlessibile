<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function stripes()
    {
        return $this->hasMany('App\Stripe');
    }

    public function referents()
    {
    	return $this->belongsToMany('App\User');
    }

    public function isFull()
    {
    	foreach($this->stripes as $stripe)
    	{
    		if($stripe->users()->count() < $this->maxStudentsPerStripe)
    			return 0;
    	}
    	return 1;
    }
}
