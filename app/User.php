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

    public function stripes()
    {
        return $this->belongsToMany('App\Stripe');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    
    /*
    public function courses()
    {
        return $this->hasMany('App\Course');
    }
    * Maybe in the next version... */

    public function hasStripeOccupied(Stripe $stripe)
    {
        if($this->stripes()->find($stripe->id))
            return 1;
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
