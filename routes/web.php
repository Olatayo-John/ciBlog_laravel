<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TestController;


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


Route::controller(PagesController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('support', 'support')->name('support');
});

Route::resource('post', PostController::class);

Route::middleware(['auth','role_permission'])->group(function () {
    Route::middleware(['verified'])->group(function () {
        Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    });

    Route::resource('comment', CommentController::class);
    Route::resource('profile', ProfileController::class);
    Route::get('my-posts', [PostController::class, 'userPosts'])->name('my-posts');
    Route::delete('postImage/{post}',[PostController::class,'postImageDelete'])->name('delete-post-image');

    // Route::resource('user', UserController::class);
    // Route::resource('setting', SettingsController::class);

    Route::resource('usersetting', UserSettingController::class);
});




Route::get('/mailable', function () {
    $user = auth()->user();
    return new App\Mail\NotifyUserPasswordChangeMail($user);
});
Route::get('/tokencrypt/{id}', [TestController::class, 'tokencrypt']);

Route::get('login-basic', function () {
})->middleware('auth.basic');

require __DIR__ . '/auth.php';
