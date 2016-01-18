<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Stripe as Stripe;
use Redirect;
use App\Course as Course;
use App\Role as Role;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'name', 'surname', 'class', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function referringInStripe($stripe_number)
    {
        foreach ($this->courses() as $course) {
            dd($course->stripes()->where('stripe_number','=',$sn));
        }
        
            if($course->hasStripe($stripe_number))
                return 1;
        return 0;
    }

    public function courseWithStripe($stripe_number)
    {
        foreach ($this->courses as $course) {
            if($course->hasStripe($stripe_number))
            {
                return $course;
            }
        }
        return 0;
    }

    public function userIsRefInCourse($id)
    {
        $course_ = Course::find($id);
        foreach ($this->courses as $course) {
            if($course->id == $course_->id)
                return 1;
        }
        return 0;
    }

    public function signToAllStripesForCourse($id)
    {
        $course = Course::find($id);
        foreach ($course->stripes as $stripe) {
            $this->stripes()->attach($stripe);
        }
    }

    public function stripes()
    {
        return $this->belongsToMany('App\Stripe');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    

    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }

    public function hasStripeOccupied(Stripe $stripe)
    {   
        $str = $this->stripes()->where("stripe_number",$stripe->stripe_number)->get()->first();
        if($str != NULL){
            return 1;
        }
        return 0;
    }

    public function signUpToStripes(Course $course, $stripe_numbers)
    {
        foreach($stripe_numbers as $stripe_number)
        {
            $this->stripes()->attach($course->stripes()->where('stripe_number','=',$stripe_number)->first()->id);
        }
    }

    public function quitStripes(Course $course, $stripe_numbers)
    {
        foreach($stripe_numbers as $stripe_number)
        {
            $this->stripes()->detach($course->stripes()->where('stripe_number','=',$stripe_number)->first()->id);
        }
    }

}
