<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use App\Jobs\ReconcileAccount;

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

Route::get('/', function () {

    // 1. Basic just logging something
    
    // logger('Hello there');

    // 2. Using the dispatch method and execute code inside it
    
    // dispatch(function(){
    //     logger('I have information from the future!');
    // })->delay(now()->addMinutes(1));

    // 3. Classy and more maintanable/scalable aproach with specified classes for each Queue job

    $user = App\Models\User::first();

    // 04:16

    // dispatch(new ReconcileAccount($user));
    // The code below is functionaly the same as the line above
    ReconcileAccount::dispatch($user)->onQueue('emails');

    return "Finished";
});
