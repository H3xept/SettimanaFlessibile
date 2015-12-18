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
use Input;

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
			if($course_installer->{itoa($c+1)} != 0)
			{
				$stripe = new Stripe;
				$stripe->stripe_number = $c+1;
				$stripe->stripe_call = $course_installer->{itoa($c+1)};
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


Route::post('/courses/{course_id}/signup', function()
{	
    $input = Input::all();
    return dd($input);
});