<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Stripe as Stripe;

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

    public function isStripeFull(Stripe $stripe)
    {
    	if($stripe->users()->count() < $this->maxStudentsPerStripe)
    		return 0;
    	else 
            return 1;
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

    public function hasCall($cn)
    {
        if($this->stripes()->where('stripe_call','=',$cn)->first() != NULL)
            return "";
        else 
            return "disabled";
    }
}
