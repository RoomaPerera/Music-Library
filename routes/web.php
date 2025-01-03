<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SongsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AccountController::class, 'login'])->name('account.login');

Route::group(['prefix' => 'account'],function(){
    Route::group(['middleware' => 'guest'], function(){
        Route::get( 'register',[AccountController::class,'register'])->name('account.register');
        Route::post( 'register',[AccountController::class,'processRegister'])->name('account.processRegister');
        Route::get( 'login',[AccountController::class,'login'])->name('account.login');
        Route::post( 'login',[AccountController::class,'authenticate'])->name('account.authenticate');
    });
    Route::group(['middleware' => 'auth'], function(){
        Route::get( 'profile',[AccountController::class,'profile'])->name('account.profile');
        Route::get( 'logout',[AccountController::class,'logout'])->name('account.logout');
        Route::post( 'updateProfile',[AccountController::class,'updateProfile'])->name('account.updateProfile');
        Route::delete( 'deleteProfile',[AccountController::class,'deleteProfile'])->name('account.deleteProfile');
        Route::get( 'songs',[SongsController::class,'index'])->name('songs.index');
        Route::get( 'songs/create',[SongsController::class,'create'])->name('songs.create');
        Route::post( 'songs',[SongsController::class,'store'])->name('songs.store');
        Route::get('/songs/{id}/edit', [SongsController::class, 'edit'])->name('songs.edit');
        Route::delete('songs/{id}', [SongsController::class, 'delete'])->name('songs.delete');
        Route::put('/songs/{id}', [SongsController::class, 'update'])->name('songs.update');
        Route::get( '/comments',[CommentsController::class,'index'])->name('comments.index');
        Route::get( '/',[HomeController::class,'index'])->name('home');
    });
    
});