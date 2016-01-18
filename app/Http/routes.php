<?php

use App\Course;
use App\Stripe;
use App\CourseInstaller;
use App\User;
use App\UserInstaller;
use App\Role;

//GENERAL PURPOSE ROUTES
Route::get('/home', ['as'=>'home',function(){
	if(Auth::user()) return view("layouts.home");
	else return Redirect::to(route('auth.getLogin'));
}]);

Route::get('/help', ['as'=>'help',function(){
	if(Auth::user()) return view("layouts.help");
	else return Redirect::to(route('auth.getLogin'));
}]);

Route::get('/courses', ['as'=>'courses',function(){
	if(Auth::user()) return view("layouts.courses")->withCourses(App\Course::All());
	else return Redirect::to(route('auth.getLogin'));
}]);

Route::get('/contact', ['as'=>'contact',function(){
	if(Auth::user()) return view("layouts.contact");
	else return Redirect::to(route('auth.getLogin'));
}]);

Route::post('/contact',['as'=>'postContact2', function(){
	if(!Auth::user()) return Redirect::to(route('auth.getLogin'));
	$input = Input::all();
	$issue_msg = $input['issue'];
	$phone = "";
	$email = "";

	if(array_key_exists('phone',$input)) $phone = $input['phone'];
	if(array_key_exists('email',$input)) $email = $input['email'];

	if($issue_msg == "") return redirect(route('contact'))->withErrors(['Il campo messaggio non può essere lasciato vuoto.']);

	DB::table('issues')->insert(
		['issue_msg'=>$issue_msg,'phone'=>$phone,'email'=>$email]
		);
}]);

// ADMIN ROUTES
Route::get('/administration',['as'=>'admin',function(){
	if(userIsMod())
		return view('layouts.admin.admin');
	else
		return redirect(route("home"))->withErrors(["Non hai i privilegi necessari per l'amministrazione."]);
	}]);

Route::post('/administration/dbimport',['as'=>'admin.installDB',function(){
	if(userIsAdmin() == NULL) return redirect(route("home"))->withErrors(["Non hai i privilegi necessari per l'amministrazione."]);
	DB::table('courses')->truncate();
	DB::table('stripe_user')->truncate();
	DB::table('stripes')->truncate();
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
		$course->maxStudentsPerStripe = $course_installer->maxStudentsPerStripe + count($course->reflist());
		$course->single_stripe = $course_installer->single_stripe;
		$course->referents = $course_installer->referents;

		$course->save();

		for($c = 0; $c < 9; $c++)
		{
			if(intval($course_installer->{itoa($c+1)}) != 0)
			{
				$stripe = new Stripe;
				$stripe->stripe_number = $c+1;
				$stripe->stripe_call = $course_installer->{itoa($c+1)};
				$course->stripes()->save($stripe);
			}
		}
	}
	return redirect(route("admin"))->withSuccess("Corsi importati con successo.");
}]);
// ------

// Authentication routes
Route::get('/', ['as'=>'auth.getLogin', 'uses'=>'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as'=>'auth.postLogin','uses'=>'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as'=>'auth.logout', 'uses'=>'Auth\AuthController@getLogout']);


// Registration routes
Route::get('auth/register', ['as'=>'auth.getRegister', 'uses'=>'Auth\AuthController@getRegister']);
Route::post('auth/register', 'Auth\AuthController@postRegister');

// SIGNUP - QUIT
Route::post('/courses/{course_id}/signup/', function($course_id)
{	
	$course = Course::find($course_id);
	$input = Input::all();
	if(array_key_exists('target_id', $input) && userIsMod() == NULL) 
		return redirect(route("courses"))->withErrors(['Privilegi insufficienti.']);
	if($course->isFull()) return redirect(route("courses"))->withErrors(['Il corso è pieno.']);

	$s_user = Auth::user();
	if(array_key_exists('target_id', $input))
		$s_user = User::find($input['target_id']); 

	if($course->single_stripe)
	{
		if(count($input) < 2) return redirect(route("courses"))->withErrors(['Nessuna fascia selezionata.']);
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
			if($course->isStripeFull($stripe)){
				if(array_key_exists('target_id', $input))
					return redirect(route("admin"))->withErrors(['Una o più fasce selezionate sono piene.']);
				return redirect(route("home"))->withErrors(['Una o più fasce selezionate sono piene.']);
			}
			if($s_user->hasStripeOccupied($stripe)){
				if(array_key_exists('target_id', $input))
					return redirect(route("admin"))->withErrors(['Hai già scelto un corso per una o più fasce selezionate.']);
				return redirect(route("home"))->withErrors(['Hai già scelto un corso per una o più fasce selezionate.']);
			}
			$d_array_keys[] = substr($key, -1);
		}

		$s_user->signUpToStripes($course, $d_array_keys);
	}
	else
	{
		$stripes_number = array();
		foreach($course->stripes()->where('stripe_call','=',$input['color'])->get() as $stripe)
		{
			if($course->isStripeFull($stripe)){
				if(array_key_exists('target_id', $input))
					return redirect(route("admin"))->withErrors(["L'appello selezionato è pieno."]);
				return redirect(route("home"))->withErrors(["L'appello selezionato è pieno."]);
			}
			if($s_user->hasStripeOccupied($stripe)){
				if(array_key_exists('target_id', $input))
					return redirect(route("admin"))->withErrors(["Hai già scelto un corso per una o più fasce selezionate."]);
				return redirect(route("home"))->withErrors(["Hai già scelto un corso per una o più fasce selezionate."]);
			}
			$stripes_number[] = $stripe->stripe_number;
		}
		$s_user->signUpToStripes($course, $stripes_number);
	}
	if(array_key_exists('target_id', $input))
		return redirect(route("admin"))->withSuccess("Iscritto l'utente ".$s_user->name." ".$s_user->surname." con successo al corso ".$course->name.".");
	return redirect(route("courses"))->withSuccess("Iscritto con successo al corso ".$course->name.".");
});


Route::get('/courses/{course_id}/quit/{stripe_number?}/', ['as'=>'course.quit',function($course_id,$stripe_number = 0){

	$course = Course::find($course_id);
	if(Auth::user()->userIsRefInCourse($course_id)) return redirect(route("home"))->withErrors(['Non puoi rimuoverti dal corso in cui sei referente.']);

	$target_id = NULL;
	if(!empty($_GET['target_id']))
		$target_id = $_GET['target_id'];

	if($target_id && userIsMod() == NULL) 
		return redirect(route("courses"))->withErrors(['Privilegi insufficienti.']);

	$s_user = Auth::user();
	if($target_id)
		$s_user = User::find($target_id);

	if(!$course) {
		if($target_id)
			return redirect(route("admin"))->withErrors(["Nessun corso con l'id selezionato. Contattare Leonardo Cascianelli."]);
		return redirect(route("home"))->withErrors(["Nessun corso con l'id selezionato. Contattare Leonardo Cascianelli."]);
	}
	if($course->single_stripe)
	{
		if($stripe_number == 0){
			if($target_id)
				return redirect(route("admin"))->withErrors(["Nessun corso con l'id selezionato. Contattare Leonardo Cascianelli."]);
			return redirect(route("home"))->withErrors(["Errore nella rimozione della fascia. Contattare Leonardo Cascianelli."]);
		}
		$snumbers = array($stripe_number);
		$s_user->quitStripes($course,$snumbers);
		if($target_id)
			return redirect(route("admin"))->withSuccess("Utente ".$s_user->name." ".$s_user->surname." rimosso con successo dal corso ".$course->name." alla ".$stripe_number."° fascia.");			
		return redirect(route("home"))->withSuccess("Rimosso con successo dal corso ".$course->name." alla ".$stripe_number."° fascia.");
	}
	else
	{
		$stripes = $s_user->stripes()->where('course_id',$course_id)->get();
		if(count($stripes) == 0) {
			if($target_id)
				return redirect(route("admin"))->withErrors(["Impossibile rimuovere l'iscrizione. Contattare Leonardo Cascianelli."]);				
			return redirect(route("home"))->withErrors(["Impossibile rimuovere l'iscrizione. Contattare Leonardo Cascianelli."]);
		}
		
		$snumbers = array();
		foreach($stripes as $stripe)
		{
			if($stripe)
			{
				$snumbers[] = $stripe->stripe_number;
			}
		}

		$s_user->quitStripes($course,$snumbers);
		if($target_id)
			return redirect(route("home"))->withSuccess("Utente ".$s_user->name." ".$s_user->surname." rimosso con successo dal corso ".$course->name.".");
		return redirect(route("home"))->withSuccess("Rimosso con successo dal corso ".$course->name.".");
	}

}]);


Route::post('/administration/usersimport',['as'=>'admin.importUsers',function(){

	if(userIsAdmin() == NULL) return redirect(route("home"))->withErrors(["Non hai i privilegi necessari per l'amministrazione."]);
	DB::table('users')->truncate();
	DB::table('stripe_user')->truncate();
	DB::table('role_user')->truncate();
	ini_set('max_execution_time', 1200);

	foreach (UserInstaller::all() as $user) {
		$user_name_arr = explode(" ",$user['name']);
		$name = "";
		for ($i=0; $i < count($user_name_arr)-2 ; $i++) { 
			$name = $name.$user_name_arr[$i];
		}
		$surname = $user_name_arr[count($user_name_arr)-2];
		$class = $user_name_arr[count($user_name_arr)-1];

		$username_str = str_replace(' ', '', $name.$surname.$class);

		$pass = $user['badge'];

        $user =  User::create([
            'username' => strtolower($username_str),
            'name' => $name,
            'surname' => $surname,
            'class' => $class,
            'password' => bcrypt($pass),
        ]);

        $user->roles()->attach(Role::where('name','User')->get()->first());
	}
	return redirect(route("home"))->withSuccess("Utenti inseriti con successo.");
}]);

Route::post('/administration/setupreferents',['as'=>'admin.setupReferents',function(){

	if(userIsAdmin() == NULL) return redirect(route("home"))->withErrors(["Non hai i privilegi necessari per l'amministrazione."]);
	DB::table('course_user')->truncate();
	ini_set('max_execution_time', 1200);

	$courses = Course::all();

	foreach ($courses as $course) {
		$tmpshjit = explode("-",$course->referents);
		$referentsArray = $tmpshjit;
		foreach ($referentsArray as $ref) {

			$tmpSr = explode(" ", $ref);
			$rOsurname = last($tmpSr);
			$tmpNm = explode(" ", $ref);
			$nm_exp = array_slice($tmpNm, 0, -1);
			$rOname = implode(" ", $nm_exp);
			
			

			$cond = ['name'=>$rOname,'surname'=>$rOsurname];
			$uref = User::where($cond)->get()->first();
			if($uref != NULL)
			{
				$course->refs()->attach($uref);
				
				if($course->single_stripe)
				{
					$uref->signToAllStripesForCourse($course->id);
				}
				else
				{	
					for($i=0; $i<3;$i++)
					{
						$stripes_number = array();
						foreach($course->stripes()->where('stripe_call','=',$i+1)->get() as $stripe)
						{
							$stripes_number[] = $stripe->stripe_number;
						}
						$uref->signUpToStripes($course, $stripes_number);
					}
				}


			}
	}
	
}return redirect(route("admin"))->withSuccess("Referenti impostati con successo.");
}]);

Route::get('/administration/messages',['as'=>'admin.feedback','uses'=>'IssueController@index']);
Route::get('/contact',['uses'=>'IssueController@create']);
Route::post('/contact',['as'=>'postContact','uses'=>'IssueController@store']);

Route::delete('/administration/feedback/delete/{id}',"IssueController@destroy");

Route::post('/administration/calls/generate',function()
{
	if(userIsMod() == NULL) return redirect(route("home"))->withErrors(["Non hai i privilegi necessari per l'amministrazione."]);
	$input = Input::all();
	$class_ = $input['class'].strtolower($input['section']); 
	$users = User::where('class',$class_)->get();
	return view('layouts.admin.genCall')->withUsers($users);
});

Route::get('/user/{target_id}/edit',['as'=>'admin.editUser','uses'=>'UserController@edit']);
Route::post('/user/{target_id}/update',['as'=>'admin.updateUser','uses'=>'UserController@update']);
