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
use App\Http\Controllers\BukuTamuAnggotaController;
use App\Http\Controllers\PeminjamanBukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\AnggotaAuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');

Route::get('/', [GuestbookController::class, 'viewform'])->name('guestbook.view'); // This sets the guestbook page as the default route
// Keep the original guestbook route
Route::post('/guestbook', [GuestbookController::class, 'store'])->name('guestbook.store');

Route::get('/offline', [PeminjamanBukuController::class, 'showForm'])->name('peminjaman.form');
Route::post('/offline', [PeminjamanBukuController::class, 'pinjamBuku'])->name('peminjaman.pinjam');

Route::get('/anggota/register', [AnggotaAuthController::class, 'showRegisterForm'])->name('anggota.register');
Route::post('/anggota/register', 'AnggotaAuthController@register');

//Anggota Login
Route::get('/anggota/login', 'AnggotaAuthController@showLoginForm')->name('anggota.login');
Route::post('/anggota/login', 'AnggotaAuthController@login');

Route::get('/perpustakaan', [PublicController::class, 'perpustakaan'])->name('perpustakaan');
Route::get('/semuabuku', [PublicController::class, 'semuabuku'])->name('semuabuku');
Route::get('/katalog', [PublicController::class, 'semuabuku'])->name('semuabuku');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');

Route::get('/cari-buku', [PublicController::class, 'searchBooks'])->name('cari-buku');

Route::post('/bukutamu-anggota/store', [BukuTamuAnggotaController::class, 'store'])->name('bukutamu_anggota.store');
Route::get('/getAnggotaInfo/{nomorAnggota}', [BukuTamuAnggotaController::class, 'getAnggotaInfo'])->name('bukutamu_anggota.getAnggotaInfo');

//Peminjaman Offline Anggota
// Route untuk halaman peminjaman


//Middleware Anggota
Route::middleware(['auth:anggota', 'anggota'])->group(function () {
	Route::get('/anggota/dashboard', 'AnggotaController@dashboard')->name('anggota.dashboard');
	//Halaman Anggota
	Route::get('/anggota/dashboard', [AnggotaAuthController::class, 'dashboard'])->name('anggota.dashboard');
	//Edit Profil
	Route::get('/edit-profil/{id}', [AnggotaController::class, 'editProfil'])->name('edit_profil');
	Route::post('/update-profil/{id}', [AnggotaController::class, 'updateProfil'])->name('update_profil');
	// Pencarian Buku
	Route::get('/anggota/cari-buku', [AnggotaController::class, 'cariBuku'])->name('anggota.cari-buku');
	Route::post('/anggota/hasil-pencarian', [AnggotaController::class, 'hasilPencarian'])->name('anggota.hasil-pencarian');

	// Route::get('/dashboard', 'MemberDashboardController@index')->name('member.dashboard');
	Route::post('/anggota/search-books', 'MemberDashboardController@searchBooks')->name('member.search.books');

	//Peminjaman Buku Anggota
	Route::get('/anggota/peminjaman', 'AnggotaController@showPeminjamanForm')->name('anggota.peminjaman.form');
	Route::get('/anggota/list', 'AnggotaController@showPeminjamanDaftar')->name('anggota.list');

	// Route::get('/peminjaman', [PeminjamanBukuController::class, 'store'])->name('anggota.peminjaman.form');
	Route::post('/peminjaman/store', [PeminjamanBukuController::class, 'store'])->name('anggota.peminjaman.store');


	// Route::get('/anggota/cari-buku', [AnggotaController::class, 'cariBuku'])->name('anggota.cariBuku');
	// Menampilkan daftar permintaan peminjaman
	Route::get('/peminjaman/daftar', [PeminjamanBukuController::class, 'daftarPeminjaman'])->name('anggota.peminjaman.daftar');

	Route::get('/anggota/profile', 'AnggotaController@showProfile')->name('anggota.profile');
	Route::get('/anggota/profile/change-password', [AnggotaController::class, 'showChangePasswordForm'])->name('anggota.profile.change-password');
	Route::post('/anggota/profile/change-password', [AnggotaController::class, 'changePassword'])->name('anggota.profile.change-password.post');

	//Logout Anggota
	Route::get('/anggota/logout', 'AnggotaAuthController@logout')->name('anggota.logout');
});
// Formulir Permintaan Peminjaman Buku
// Route::get('/anggota/buat-permintaan', [AnggotaController::class, 'buatPermintaan'])->name('anggota.buat-permintaan');
// Route::post('/anggota/simpan-permintaan', [AnggotaController::class, 'submitPermintaan'])->name('anggota.simpan-permintaan');
//Caribuku


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

	Route::get('/list-anggota/{id}/edit', 'HomeController@editAnggota')->name('list-anggota-edit');
	Route::put('/list-anggota/{id}', 'HomeController@updateAnggota')->name('list-anggota-updateAnggota');

	// List Anggota
	Route::get('/list-anggota', [HomeController::class, 'listAnggota'])->name('list-anggota');
	Route::get('/list-anggota/{id}', [HomeController::class, 'showAnggota'])->name('list-anggota-detail');

	Route::delete('/list-anggota/{id}', [HomeController::class, 'deleteAnggota'])->name('list-anggota-delete');

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

	Route::get('/admin/profile', 'HomeController@showProfile')->name('admin.profile');
	Route::get('/admin/profile/change-password', [HomeController::class, 'showChangePasswordForm'])->name('admin.profile.change-password');
	Route::post('/admin/profile/change-password', [HomeController::class, 'changePassword'])->name('admin.profile.change-password.post');

	// Render Guestbook View
	Route::get('/guestbook-view', [GuestbookController::class, 'viewbook'])->name('guestbook.view');

	// Update Buku
	Route::get('/books/{id}/edit', 'BooksController@edit')->name('books.edit');
	Route::put('/books/{id}', 'BooksController@update')->name('books.update');

	//Detail Buku
	Route::get('/books/{id}/detail', 'BooksController@showDetail')->name('books.detail');

	//Hapus Buku
	Route::delete('/all-books/{id}/delete', 'BooksController@destroyBook')->name('books.destroy');

	Route::get('/peminjaman/daftar', [PeminjamanBukuController::class, 'daftarPermintaanPeminjaman'])->name('admin.peminjaman.daftar');

	// Menyetujui permintaan peminjaman
	Route::put('/peminjaman/approve/{id}', [PeminjamanBukuController::class, 'approve'])->name('admin.peminjaman.approve');

	//Kembalikan Buku
	Route::get('/admin/buku-dikembalikan', [PeminjamanBukuController::class, 'bukuDikembalikan'])->name('admin.buku-dikembalikan');
	Route::put('/admin/peminjaman/{id}/kembalikan', [PeminjamanBukuController::class, 'kembalikanBukuAnggota'])->name('admin.peminjaman.kembalikan');

	Route::get('/cari-anggota/{nomorAnggota}', 'AnggotaController@cariAnggotaByNomorAnggota');

	//Caribuku yang dipinjam

	Route::get('/find-issue-book/{bookId}', [BooksController::class, 'findBorrowedBook']);



	Route::get('/admin/buku-dipinjam', [PeminjamanBukuController::class, 'bukuDipinjam'])->name('admin.buku-dipinjam');

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
