<?php

use App\Livewire\FormUser;
use App\Livewire\Simulators\Simu1;
use App\Livewire\Simulators\Simu2;
use App\Livewire\Simulators\Simu3;
use App\Livewire\WelcomeUser;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', WelcomeUser::class);

Route::get('/form',FormUser::class);

Route::get('/simu1',Simu1::class);

Route::get('/simu2',Simu2::class);

Route::get('/simu3',Simu3::class);
