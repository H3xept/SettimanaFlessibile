<?php

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
		$course->single_stripe = $course_installer->single_stripe;
		$course->referents = $course_installer->referents;

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


Route::post('/courses/{course_id}/signup', function($course_id)
{	

	$course = Course::find($course_id);
	$input = Input::all();
	if($course->isFull()) return redirect(route("courses"))->withErrors(['Il corso è pieno.']);

	if($course->single_stripe)
	{
		$values = array();
		for($c = 0; $c < 9; $c++)
		{
			if(array_key_exists("f".($c+1),$input))
				$values["f".($c+1)] = $input["f".($c+1)];
		}
		$d_array_keys = array();

		foreach($values as $key => $val)
		{
			$stripe = $course->stripes()->where('stripe_number','=',substr($key, -1))->first();
			if($course->isStripeFull($stripe))
				return redirect(route("home"))->withErrors(['Una o più fasce selezionate sono piene.']);
			if(Auth::user()->hasStripeOccupied($stripe))
				return redirect(route("home"))->withErrors(['Hai già scelto un corso per una o più fasce selezionate.']);
			$d_array_keys[] = substr($key, -1);
		}

		Auth::user()->signUpToStripes($course, $d_array_keys);
	}
	else
	{
		$stripes_number = array();
		foreach($course->stripes()->where('stripe_call','=',$input['color'])->get() as $stripe)
		{
			if($course->isStripeFull($stripe))
				return redirect(route("home"))->withErrors(["L'appello selezionato è pieno."]);
			if(Auth::user()->hasStripeOccupied($stripe))
				return redirect(route("home"))->withErrors(["Hai già scelto un corso per una o più fasce selezionate."]);
			$stripes_number[] = $stripe->stripe_number;
		}
		Auth::user()->signUpToStripes($course, $stripes_number);
	}
	return redirect(route("courses"))->withSuccess("Iscritto con successo al corso ".$course->name.".");
});


Route::get('/courses/{course_id}/quit/{stripe_number?}', ['as'=>'course.quit',function($course_id,$stripe_number = 0){

	$course = Course::find($course_id);
	if(!$course) return redirect(route("home"))->withErrors(["Nessun corso con l'id selezionato. Contattare Leonardo Cascianelli."]);
	if($course->single_stripe)
	{
		if($stripe_number == 0)
			return redirect(route("home"))->withErrors(["Errore nella rimozione della fascia. Contattare Leonardo Cascianelli."]);
		$snumbers = array($stripe_number);
		Auth::user()->quitStripes($course,$snumbers);
		return redirect(route("home"))->withSuccess("Rimosso con successo dal corso ".$course->name." alla ".$stripe_number."° fascia.");
	}
	else
	{
		$stripes = Auth::user()->stripes()->where('course_id',$course_id)->get();
		if(count($stripes) == 0) return redirect(route("home"))->withErrors(["Impossibile rimuovere l'iscrizione. Contattare Leonardo Cascianelli."]);
		
		$snumbers = array();
		foreach($stripes as $stripe)
		{
			if($stripe)
			{
				$snumbers[] = $stripe->stripe_number;
			}
		}

		Auth::user()->quitStripes($course,$snumbers);
		return redirect(route("home"))->withSuccess("Rimosso con successo dal corso ".$course->name.".");
	}

}]);
