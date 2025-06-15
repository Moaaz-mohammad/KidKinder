<?php

use App\Http\Controllers\AdminRequestController;
use App\Http\Controllers\ClassRequestController;
use App\Http\Controllers\ClasssController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ThemeController;
use App\Models\Classs;
use App\Models\Student;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\SmartPunct\DashParser;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Auth\VerificationController;
use Psy\Output\Theme;

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

Auth::routes(['verify' => true]);

Route::post('email/resend/message', [VerificationController::class, 'resend'])
    ->name('verification.send')
    ->middleware(['auth', 'throttle:6,1']);


Route::get('/store', [ThemeController::class, 'index'])->name('store');

Route::get('/', [ThemeController::class, 'index']);

Route::get('/about', [ThemeController::class, 'aboutPage'])->name('AboutPage');

Route::get('/classes', [ThemeController::class, 'classesPage'])->name('ClassesPage');

Route::get('/team', [ThemeController::class, 'teamPage'])->name('TeamPage');

Route::get('/gallery', [ThemeController::class, 'galleryPage'])->name('GalleryPage');

Route::get('/contact', [ThemeController::class, 'contactPage'])->name('ContactPage');

Route::get('/blog', [ThemeController::class, 'blogPage'])->name('BlogPage');

//---Onther Way To Use The Route For Pages better than last one---//
// Route::get('/{page}', [ThemeController::class, 'show'])->where('page', 'index|about|classes|blog|team|gallery|contact');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('dashboard/class/', [ClassController::class, 'index'])->name('AllClasses');
// Route::get('dashboard/class/create', [ClassController::class, 'create'])->name('CreateClass');



Route::middleware(['auth', 'verified'])->group(function(){
    // Dashboard //
    Route::get('dashboard/home/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/user/profile', [DashboardController::class, 'user_profile'])->name('UserProfile');
    Route::put('dashboard/user/profile/{id}/edit', [DashboardController::class, 'Update'])->name('user.edit');
    Route::post('dashboard/user/password/{id}/edit', [DashboardController::class, 'updatePassword'])->name('user.password.edit');
    Route::delete('dashboard/user/photo/{id}/remove', [DashboardController::class, 'removePhoto'])->name('user.photo.remove');
     //- Classes Controller
    Route::resource('dashboard/class', ClasssController::class);
    Route::resource('dashboard/teacher', TeacherController::class);
    Route::resource('dashboard/student', studentController::class);
    // Admin Requests Controller
    Route::get('user/requests/list', [AdminRequestController::class, 'index'])->name('admin.requests.index');
    Route::post('user/requests/{id}/approve', [AdminRequestController::class, 'approve'])->name('admin.requests.approve');
    Route::post('user/requests/{id}/reject', [AdminRequestController::class, 'reject'])->name('admin.requests.reject');
    Route::post('user/requests/{id}/pending', [AdminRequestController::class, 'pending'])->name('admin.requests.pending');
    Route::get('user/{id}/requests/show', [AdminRequestController::class, 'show'])->name('admin.requests.show');
    //- View Blade 
    Route::get('classes/{id}/join/', [ThemeController::class, 'joinClass'])->name('join.class');
    Route::post('class/join', [ClassRequestController::class, 'store'])->name('class.request.store');
    Route::get('class/requests/view', [ClassRequestController::class, 'index'])->name('requests.index');
    Route::get('class/{id}/request/show', [ClassRequestController::class, 'show'])->name('request.show');
    // User Profile
    Route::get('user/profile', [ThemeController::class, 'showProfile'])->name('userProfile');
    Route::post('user/profile/{id}', [ThemeController::class, 'update'])->name('settingsUpdate');
});


// Route::moddleware(['auth', 'verified'])->group(function () {

// });




// Route::get('/', function () {

// })->middleware(['auth', 'verified']);

