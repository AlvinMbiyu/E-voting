<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Voter;
use App\Http\Livewire\Location;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('voter/register', [Voter::class, 'create'])
    ->name('register');
Route::post('voter/register', [Voter::class, 'authRegister']);

Route::get('voter/login', [Voter::class, 'login'])
    ->name('login');
Route::post('voter/login', [Voter::class, 'auth']);

Route::get('admin/register', [Admin::class, 'create'])
    ->name('admregister');
Route::post('admin/register', [Admin::class, 'authRegister']);

Route::get('admin/login', [Admin::class, 'login'])
    ->name('login');
Route::post('admin/login', [Admin::class, 'auth']);



Route::middleware(['voter'])->group(function () {

    Route::get('voter/dashboard', [Voter::class, 'voterDashboard']);
    Route::get('/vote', [Voter::class, 'index'])->name('vote.index');
    Route::post('/vote', [Voter::class, 'vote'])->name('vote.submit');
    Route::post('/vote/preview', [Voter::class, 'preview'])->name('vote.preview');
    
});

Route::middleware(['admin'])->group(function () {

    Route::get('admin/dashboard', [Admin::class, 'adminDashboard']);
    
});
