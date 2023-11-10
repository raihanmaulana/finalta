<?php

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

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\AnggotaAuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [GuestbookController::class, 'viewbook'])->name('guestbook.view'); // This sets the guestbook page as the default route
Route::get('/guestbook', [GuestbookController::class, 'viewbook'])->name('guestbook.view'); // Keep the original guestbook route
Route::post('/guestbook', [GuestbookController::class, 'store'])->name('guestbook.store');

// Route::get('/', function () {
//     return view('welcome');
// });

// use App\Http\Controllers\AnggotaController;

//Halaman Anggota
Route::get('/anggota/dashboard', [AnggotaAuthController::class, 'dashboard'])->name('anggota.dashboard');

// Pencarian Buku
Route::get('/anggota/cari-buku', [AnggotaController::class, 'cariBuku'])->name('anggota.cari-buku');
Route::post('/anggota/hasil-pencarian', [AnggotaController::class, 'hasilPencarian'])->name('anggota.hasil-pencarian');




//Anggota Register
Route::get('/anggota/register', [AnggotaAuthController::class, 'showRegisterForm'])->name('anggota.register');
Route::post('/anggota/register', 'AnggotaAuthController@register');

//Anggota Login
Route::get('/anggota/login', 'AnggotaAuthController@showLoginForm')->name('anggota.login');
Route::post('/anggota/login', 'AnggotaAuthController@login');

//Peminjaman Buku Anggota
Route::get('/anggota/peminjaman', 'AnggotaController@showPeminjamanForm')->name('anggota.peminjaman.form');
Route::post('/anggota/peminjaman', 'AnggotaController@submitPeminjaman')->name('anggota.peminjaman.submit');

//Middleware Anggota
Route::middleware(['auth:anggota', 'anggota'])->group(function () {
	Route::get('/anggota/dashboard', 'AnggotaController@dashboard')->name('anggota.dashboard');
});
// Formulir Permintaan Peminjaman Buku
Route::get('/anggota/buat-permintaan', [AnggotaController::class, 'buatPermintaan'])->name('anggota.buat-permintaan');
Route::post('/anggota/simpan-permintaan', [AnggotaController::class, 'submitPermintaan'])->name('anggota.simpan-permintaan');

//Logout Anggota
Route::get('/anggota/logout', 'AnggotaAuthController@logout')->name('anggota.logout');

//Admin untuk kelola peminjaman buku
// Route::middleware(['auth', 'guest'])->group(function () {
// 	Route::get('/admin/peminjaman', 'StudentController@listPeminjaman')->name('admin.peminjaman.list');
// 	Route::get('/admin/peminjaman/approve/{id}', 'Student@approvePeminjaman')->name('admin.peminjaman.approve');
// });

Route::get('/admin/peminjaman', 'StudentController@listPeminjaman')->name('admin.peminjaman.list');


// Unauthenticated group 
Route::group(array('before' => 'guest'), function () {

	// CSRF protection 
	Route::group(array('before' => 'csrf'), function () {

		// Create an account (POST) 
		Route::post('/create', array(
			'as' => 'account-create-post',
			'uses' => 'AccountController@postCreate'
		));

		// Sign in (POST) 
		Route::post('/sign-in', array(
			'as' => 'account-sign-in-post',
			'uses' => 'AccountController@postSignIn'
		));

		// Sign in (POST) 
		Route::post('/student-registration', array(
			'as' => 'student-registration-post',
			'uses' => 'StudentController@postRegistration'
		));
	});

	// Sign in (GET) 
	Route::get('/signin', array(
		'as' 	=> 'account-sign-in',
		'uses'	=> 'AccountController@getSignIn'
	));

	// Create an account (GET) 
	Route::get('/create', array(
		'as' 	=> 'account-create',
		'uses' 	=> 'AccountController@getCreate'
	));

	// Student Registeration form 
	Route::get('/student-registration', array(
		'as' 	=> 'student-registration',
		'uses' 	=> 'StudentController@getRegistration'
	));

	// Render search books panel
	Route::get('/book', array(
		'as' => 'search-book',
		'uses' => 'BooksController@searchBook'
	));

	Route::post('book/create', [BooksController::class, 'store'])->name('book.store');
});

// Main books Controlller left public so that it could be used without logging in too
Route::resource('/books', 'BooksController');

// Authenticated group 
// Route::group(array('before' => 'auth'), function() {
Route::group(['middleware' => ['auth']], function () {

	// Home Page of Control Panel
	Route::get('/home', array(
		'as' 	=> 'home',
		'uses'	=> 'HomeController@home'
	));

	// Render Add Books panel
	Route::get('/add-books', array(
		'as' => 'add-books',
		'uses' => 'BooksController@renderAddBooks'
	));

	Route::get('/add-book-category', array(
		'as' => 'add-book-category',
		'uses' => 'BooksController@renderAddBookCategory'
	));

	Route::post('/kategoribuku', 'BooksController@KategoriBukuStore')->name('bookcategory.store');


	// Render All Books panel
	Route::get('/all-books', array(
		'as' => 'all-books',
		'uses' => 'BooksController@renderAllBooks'
	));

	Route::get('/bookBycategory/{cat_id}', array(
		'as' => 'bookBycategory',
		'uses' => 'BooksController@BookByCategory'
	));

	// Students
	Route::get('/registered-students', array(
		'as' => 'registered-students',
		'uses' => 'StudentController@renderStudents'
	));

	// Render students approval panel
	Route::get('/students-for-approval', array(
		'as' => 'students-for-approval',
		'uses' => 'StudentController@renderApprovalStudents'
	));

	// Render students approval panel
	Route::get('/settings', array(
		'as' => 'settings',
		'uses' => 'StudentController@Setting'
	));

	// Render students approval panel
	Route::post('/setting', array(
		'as' => 'settings.store',
		'uses' => 'StudentController@StoreSetting'
	));

	// Main students Controlller resource
	Route::resource('/student', 'StudentController');

	Route::post('/studentByattribute', array(
		'as' => 'studentByattribute',
		'uses' => 'StudentController@StudentByAttribute'
	));

	// Issue Logs
	Route::get('/issue-return', array(
		'as' => 'issue-return',
		'uses' => 'LogController@renderIssueReturn'
	));

	// Render logs panel
	Route::get('/currently-issued', array(
		'as' => 'currently-issued',
		'uses' => 'LogController@renderLogs'
	));

	// Main Logs Controlller resource
	Route::resource('/issue-log', 'LogController');

	// Sign out (GET) 
	Route::get('/sign-out', array(
		'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignOut'
	));
});
Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
