<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\AuthorizationController;


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
    Route::get('/', 'index')->name('home');
    Route::get('support', 'support')->name('support');
});


Route::middleware(['auth', 'role_permission'])->group(function () {
    Route::middleware(['verified'])->group(function () {
        Route::get('dashboard', [PagesController::class, 'dashboard'])->name('dashboard');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('user', UserController::class);
        Route::put('user-role/{user}', [UserController::class, 'userRole'])->name('user-role.update');

        Route::get('authorization', AuthorizationController::class)->name('authorization');
    });

    Route::resource('comment', CommentController::class);

    Route::resource('profile', ProfileController::class);

    Route::get('my-posts', [PostController::class, 'userPosts'])->name('my-posts');
    Route::delete('postImage/{post}', [PostController::class, 'postImageDelete'])->name('delete-post-image');

    Route::resource('usersetting', UserSettingController::class);

    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('read-notification', [NotificationController::class, 'markAsRead'])->name('read-notification');
});

Route::resource('post', PostController::class);




Route::get('/mailable', function () {
    $user = auth()->user();
    return new App\Mail\UserPasswordChangeMail($user);
});
Route::get('/tokencrypt/{id}', [TestController::class, 'tokencrypt']);

Route::get('login-basic', function () {
})->middleware('auth.basic');

require __DIR__ . '/auth.php';
