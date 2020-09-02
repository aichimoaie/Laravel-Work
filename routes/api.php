<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'auth'
], function() {
    Route::post('login','API\Auth\AuthController@login');
    Route::post('register','API\Auth\AuthController@register');
    Route::get('signup/activate/{token}','API\Auth\AuthController@signupActivate');

    Route:: group([
        'middleware' => 'auth:api'
    ],
    function(){
        Route::get('logout', 'API\Auth\AuthController@logout');
        Route::get('user', 'API\Auth\AuthController@user');

        Route::get('/users/roles', 'API\Users\UserController@roles');
        Route::resource('/users', 'API\Users\UserController');


    });
});

// Route::post('/register', 'API\Auth\AuthController@register');
// Route::post('/login', 'API\Auth\AuthController@login');

Route::apiResource('/ceo', 'API\CEOController')->middleware('auth:api');


Route::get('/quiz/list', 'API\Quizzes\QuizController@list');
Route::apiResource('/quiz', 'API\Quizzes\QuizController'); //->middleware('auth:api');



Route::get('/my_roles', 'ExamplesController@show_my_roles')->middleware('auth:api');
Route::resource('/post', 'PostsController');//->middleware('auth:api');



