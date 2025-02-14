<?php

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



Route::middleware(['auth'])->group(function(){
    // Dashboard //
    Route::get('dashboard/home/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/user/profile', [DashboardController::class, 'user_profile'])->name('UserProfile');
     //- Classes Controller
    Route::resource('dashboard/class', ClasssController::class);
    Route::resource('dashboard/teacher', TeacherController::class);
    Route::resource('dashboard/student', studentController::class);

});





Auth::routes([
    'verify' => true
]);

// Route::get('/', function () {

// })->middleware(['auth', 'verified']);