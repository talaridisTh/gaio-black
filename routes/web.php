<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\StorageController;
use App\Http\Livewire\Admin\Information\Information;
use App\Http\Livewire\Admin\Information\Sales;
use App\Http\Livewire\Admin\Storage\CreateStorage;
use App\Http\Livewire\Admin\Storage\RemoveStorage;

use App\Http\Livewire\Admin\Storage\ShowStorage;
use App\Http\Livewire\Admin\Storage\Storage;
use App\Http\Livewire\Admin\Storage\UpdateStorage;
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
Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
})->name('dashboard');

Route::middleware("auth:sanctum")->group(function (){

    Route::get("/users", [UserController::class, "index"])->name("users.index");
    Route::get("/users/create", [UserController::class, "create"])->name("users.create");

    Route::get("/storage",ShowStorage::class)->name("storage.index");
    Route::get("/storage/create", CreateStorage::class)->name("storage.create");
    Route::get("/storage/add", Storage::class)->name("storage.add");
    Route::get("/storage/remove",RemoveStorage::class)->name("storage.remove");
    Route::get("/storage/edit/{storage}",UpdateStorage::class)->name("storage.update");


    Route::get("/information", Information::class)->name("information.index");
    Route::get("/sales", Sales::class)->name("sales.index");

    Route::post("/user/excel-upload", [UserController::class,"userImport"])->name("user.upload");



});
