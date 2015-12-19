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

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function hasStripeOccupied(Stripe $stripe)
    {
        if($this->stripes()->find($stripe->id))
            return 1;
        return 0;
    }

    public function signUpToStripes(Course $course, $array)
    {
        foreach($array as $stripe_number)
        {
            $this->stripes()->attach($course->stripes()->where('stripe_number','=',$stripe_number)->first()->id);
        }
        return Redirect::to(route("home"))->withErrors(["AYY"]);
    }

}
