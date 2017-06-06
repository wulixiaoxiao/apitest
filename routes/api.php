<?php

use Illuminate\Http\Request;

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
Route::get('/test', function (){
    /**
     * Simple function to replicate PHP 5 behaviour
     */
    function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
    list($usec, $sec) = explode(" ", microtime());
    var_dump($usec);
    exit;

    $time_start = microtime_float();

// Sleep for a while
    usleep(100);

    $time_end = microtime_float();
    $time = $time_end - $time_start;

    echo "Did nothing in $time seconds\n";
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/', 'IndexController@index');
    Route::post('/renqiOrder', 'RenqiController@send');
});


