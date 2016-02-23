<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


//root
// Route::get('/', function()
// {
// 	return View::make('categories');
// });


//current start/home/root - all posts
Route::get('posts', function()
{
	//get all the posts into an array-like object
	$aPosts = Post::paginate(3);

	//make posts view (refers to posts.blade.php) with the $aPosts array (data binding)
	return View::make('posts')->with('posts',$aPosts);
});



//View a category and its posts use case
Route::get('categories/{id}', function($id)
{
	$oCategory = Category::find($id);
	return View::make('category')->with('category', $oCategory);
});



//Display a post use case
Route::get('posts/{id}', function($id)
{
	$oPost = Post::find($id);

	return View::make('postsingular')->with('post',$oPost);
})->where("id","[0-9]+");



//Create user usecase - 2 routes:

//get submit form to create new user

Route::get('users/create', function()
{
	return View::make('register');
});

//submit the create user form to server
Route::post('users', function()
{
	//validate input
	//1. create validation rules

	$aRules =  array(
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required|email|unique:users'
   
    );

	//2. use the rules to validate
	$oValidator = Validator::make(Input::all(),$aRules);
 

	if($oValidator->fails()){

		//redirect to registration form (resource) with error msgs and sticky data
		return Redirect::to("users/create")->withInput()->withErrors($oValidator);

	}else{
		//create new user

		//get all user detail
		$aDetails = Input::all();
		$aDetails["password"] = Hash::make($aDetails["password"]);
		User::create($aDetails);

		return Redirect::to("posts");

	}

});


//Authentication/login use case:
//request and response model

//get form to fill in
Route::get('login', function()

{	
		//make is a View class static method
	return View::make('login');
	

});

//post form + input back to server(submit)
			//route
Route::get('login', function()
{
	return View::make('login');

});

Route::post('login', function()
{
	$aLoginDetails = array(
		"email"   =>Input::get("email"),
		"password"=>Input::get("password")	//Input is a static method

	);

	//stores current userid in the session
	if(Auth::attempt($aLoginDetails)){ //attempt checks database for a match - stores session in flash data
		//COULD BE INTENDED INSTEAD OF TO (SENDS USER TO PREVIOUS PAGE)
		return Redirect::to('posts'); 
		//OR if correct redirect to the user who has just logged in( .Auth::user()->id )

	}else{

		return Redirect::to('login')->with('error','Please try to login again.'); //if wrong redirect to login page (303 error)(with is flash data  not binding)

	} //with means to save the session in flash data

});


//remove the logged in user & redirect to login page 
Route::get('logout', function()
{	
	Auth::logout();

	return Redirect::to("posts");

});



//New post use case

Route::get('posts/create', function()
{
	return View::make('newPost');


})->before("auth|admin"); 
//run auth filter before executing the route (security)
//filter chaining


//submit the post form to the server
Route::post('posts', function()
{

	$aRules = array(
		'title' => 'required',
        'subtitle' => 'required',
        'photo' => 'required',
        'content' => 'required'
   
    );

	//2. use the rules to validate
	$oValidator = Validator::make(Input::all(),$aRules);
 

	if($oValidator->fails()){

		return Redirect::to("posts/create")->withInput()->withErrors($oValidator);

	}else{

		//create new post

		//get file
		$sNewName = Input::get("title").".".

						Input::file("photo")->getClientOriginalExtension();

		//move photo from temp location
		Input::file("photo")->move("postphotos",$sNewName);

		$aDetails = Input::all();

		$aDetails["photo"] = $sNewName;
		$aDetails["user_id"] = Auth::user()->id;

		Post::create($aDetails);

		return Redirect::to("categories/".Input::get("category_id"));

	}

		//auth filter | admin filter
})->before("auth|admin"); //filter chaining



//New Comment use case

Route::post('comments', function()
{

		$aDetails = Input::all();

		$aDetails["user_id"] = Auth::user()->id;

		Comment::create($aDetails);

		return Redirect::to("posts/".Input::get("post_id"));



})->before("auth"); 



//Delete a comment use case (soft delete)
//make deleted_at field in db = NULL

Route::delete('comments/{id}', function($id)
{

	//find comment by id & delete
	$oComment = Comment::find($id);

	//get the postid from the comment
	$iPostID = $oComment->post_id;

	$oComment->delete();
	//return back to post
	return Redirect::to("posts/".$iPostID);


})->before("auth"); 



//Delete a Post use case (soft delete)

Route::delete('posts/{id}', function($id)
{

	//find post by id & delete
	$oPost = Post::find($id);


	$oPost->delete();
	//return back to main posts view
	return Redirect::to("posts");


})->before("auth");



//Edit Post use case - 2 routes:
	
//get Post id - read, with sticky data
Route::get('posts/{id}/edit', function($id)

{	$oPost = Post::find($id);
	return View::make('postEdit')->with('post',$oPost);
	

})->before("auth"); //run auth filter before executing the route (security)


//submit req - update
Route::put('posts/{id}', function($id)

{			
	//validate input
	//1. create validation rules

	$aRules =  array(

        'title' => 'required',
        'subtitle' => 'required',
        'photo' => 'required',
        'content' => 'required'
   
    );

	//2. use the rules to validate
	$oValidator = Validator::make(Input::all(),$aRules);
 

	if($oValidator->fails()){

		return Redirect::to("posts/".$id."/edit")->withInput()->withErrors($oValidator);

	}else{

		//get file
		$sNewName = Input::get("title").".".

		Input::file("photo")->getClientOriginalExtension();

		//move photo from temp location
		Input::file("photo")->move("postphotos",$sNewName);

		//get all post details
		$aDetails = Input::all();

		$aDetails["photo"] = $sNewName;

		$oPost = Post::find($id);
		$oPost->fill($aDetails);
		$oPost->save();

		return Redirect::to("posts/".$id);


	}

})->before("auth"); //run auth filter before executing the route (security)