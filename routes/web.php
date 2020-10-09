<?php

use RealRashid\SweetAlert\Facades\Alert;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test','FirebaseController@test');
Route::get('/getData','FirebaseController@getData');
// Route::get('/signUp','FirebaseController@signUp');
// Route::get('/signIn','FirebaseController@signIn');
// Route::get('/signOut','FirebaseController@signOut');


Route::get('/firebase',[
    'uses' => 'FirebaseController@index',
    'as'=>'firebase'
]);

Route::get('/signUpForm', function () {
    Alert::success('Success Title', 'Success Message');
    return view('signUp');
});

Route::get('/signInForm', function () {
    return view('signIn');
});


Route::get('/comnt', function () {

    return view('comment');
});


Route::post('/signIn',[
    'uses' => 'HomeController@signIn',
    'as'=>'signIn'
]);
Route::post('/signUp',[
    'uses' => 'HomeController@signUp',
    'as'=>'signUp'
]);

Route::get('/signOut', function(){
    Session::forget('uid');
    return view('signIn');
});


Route::group(['middleware'=>'firebase'],function(){

    
    Route::get('/','HomeController@index');

    Route::get('/following',[
        'uses' => 'HomeController@following',
        'as'=>'following'
    ]);

    Route::get('/show_followings',[
        'uses' => 'UsersController@followings',
        'as'=>'show.followings'
    ]);
    Route::get('/show_followers',[
        'uses' => 'UsersController@followers',
        'as'=>'show.followers'
    ]);

    
    Route::get('/add_project',[
        'uses' => 'HomeController@addProject',
        'as'=>'add_project'
    ]);

    Route::post('/store_project',[
        'uses' => 'HomeController@storeProject',
        'as'=>'store.project'
    ]);
    

    Route::get('/projects',[
        'uses' => 'HomeController@projects',
        'as'=>'projects'
    ]);

    
    Route::get('/userInfo',[
        'uses' => 'UsersController@index',
        'as'=>'user_info'
    ]);

    Route::post('/update',[
        'uses' => 'UsersController@update',
        'as'=>'update.user'
    ]);
    
    Route::get('/follow_user/{id}',[
        'uses' => 'HomeController@followUser',
        'as'=>'follow.user'
    ]);

    Route::get('/follow/{id}',[
        'uses' => 'HomeController@followProject',
        'as'=>'follow.project'
    ]);
    


    


Route::get('/{id}',[
    'uses' => 'HomeController@projectDetails',
    'as'=>'project'
]);
Route::post('/comment',[
    'uses' => 'HomeController@comment',
    'as'=>'comment'
]);



//------------------------dashboard section--------------

    
});


// Route::get('/contact', function () {
// 	$languages=['PHP','C#','ASP.Net','C++','jQuery'];
//     return view('contact',['lang'=>$languages]);
// });
Route::get('/languages','languagesController@list');

//Route::view('/contact','contact');
// Route::view("/login","Login.login");
// Route::get("/login","Login.login");//we can change the URL 
Route::get("/login","LoginController@login");
Route::post("/login","HomeController@info");
Route::get("/registration","RegistrationController@register");
// Route::view("/registration","RegistrationController@register");

Route::get('/contact','ContactController@contact');
