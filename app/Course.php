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

    public function refs()
    {
    	return $this->belongsToMany('App\User');
    }

    public function reflist()
    {
        return explode("-",$this->referents);
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
            return 1;
        else 
            return 0;
    }

    public function hasStripe($sn)
    {
        if($this->stripes->where('stripe_number','=',$sn)->first() != NULL)
            return 1;
        else 
            return 0;
    }

    public function isCallFull($cn)
    {
        $stripe = $this->stripes()->where('stripe_call','=',$cn)->first();
        if(!$stripe) return 0;
        if($this->isStripeFull($stripe))
            return 1;
        return 0;
    }

    public function studentsSigned()
    {
        $studs = array();
        foreach($this->stripes()->get() as $stripe)
        {
            foreach($stripe->users()->get() as $user)
            {
                $studs[] = $user;
            }
        }

        return array_unique($studs);
    }

    public function studentsSignedInStripeCall($stripe_call)
    {
        $stripe = $this->stripes()->where('stripe_call', '=',$stripe_call)->first();

        if($stripe == null)
            return null;

        $studs = array();
        foreach($stripe->users()->get() as $user)
        {
            $studs[] = $user;
        }

        return $studs;

    }

    public function n_studentsSigned()
    {
        return count($this->studentsSigned());
    }

    public function n_studentsSignedInStripeCall($stripe_call)
    {
        return count($this->studentsSignedInStripeCall($stripe_call));
    }
    
//Disabled returning

    public function disabledCheck($cn)
    {
        if($this->hasCall($cn) && !$this->isCallFull($cn))
            return "";
        return "disabled";
    }
}
