<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Course;
use App\Stripe;
use App\CourseInstaller;

Route::get('/home', ['as'=>'home',function(){
	if(Auth::user())
	{return view("layouts.home");}
	else return Redirect::to(route('auth.getLogin'));
}]);

Route::get('/courses', ['as'=>'courses',function(){
	if(Auth::user())
	{return view("layouts.courses")->withCourses(App\Course::All());}
	else return Redirect::to(route('auth.getLogin'));
}]);

Route::get('/courses/create',['uses'=>'CourseController@create']);

//Stripe creation
function generateRandomString($len) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLen = strlen($chars);
    $rt = '';
    for ($i = 0; $i < $len; $i++) {
        $rt .= $chars[rand(0, $charLen - 1)];
    }
    return $rt;
}

function itoa($int) {
	switch ($int) {
		case 1:
			return "one";
			break;
		case 2:
			return "two";
			break;
		case 3:
			return "three";
			break;
		case 4:
			return "four";
			break;
		case 5:
			return "five";
			break;
		case 6:
			return "six";
			break;
		case 7:
			return "seven";
			break;
		case 8:
			return "eight";
			break;
		case 9:
			return "nine";
			break;
	}
}

Route::post('/courses/create/dbimport',['as'=>'installDB',function(){
	foreach(CourseInstaller::all() as $course_installer)
	{
		if(Course::where('name','=',$course_installer->name)->first() != NULL)
			continue;
		$course = new Course;
		do{
			$rnd = generateRandomString(5);
		}while(Course::where('u_identifier','=',$rnd)->first() != NULL);
		$course->u_identifier = $rnd;
		$course->name = $course_installer->name;
		$course->description = $course_installer->description;
		$course->maxStudentsPerStripe = $course_installer->maxStudentsPerStripe;
		$course->save();

		for($c = 0; $c < 9; $c++)
		{
			if($course_installer->{itoa($c+1)} == true)
			{
				$stripe = new Stripe;
				$stripe->stripe_number = $c+1;
				$course->stripes()->save($stripe);
			}
		}
	}
}]);
// ------

// Authentication routes
Route::get('/', ['as'=>'auth.getLogin', 'uses'=>'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as'=>'auth.postLogin','uses'=>'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as'=>'auth.logout', 'uses'=>'Auth\AuthController@getLogout']);


// Registration routes
Route::get('auth/register', ['as'=>'auth.getRegister', 'uses'=>'Auth\AuthController@getRegister']);
Route::post('auth/register', 'Auth\AuthController@postRegister');
