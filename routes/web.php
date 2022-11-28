<?php

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/charts', function () {

    dd(Order::query()
        ->whereYear('created_at', date('Y'))
        ->selectRaw(strftime('%m', (int)"created_at").' as month')
        ->selectRaw('count(*)')
        ->groupBy('month')
        ->get());



//    return view('charts');
});
