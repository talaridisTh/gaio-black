<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\StorageController;
use App\Http\Livewire\Admin\User\ShowUsers;
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
    return view('dashboard');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
//Route::get('/users', ShowUsers::class);
Route::get("/users", [UserController::class, "index"])->name("users.index");
Route::get("/users/create", [UserController::class, "create"])->name("users.create");
Route::get("/storage", [StorageController::class, "index"])->name("storage.index");

Route::get("test",function (){
 return view("welcome");
});
