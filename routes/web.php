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
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\BukuTamuAnggotaController;
use App\Http\Controllers\PeminjamanBukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuTamuUmumController;
use App\Http\Controllers\AnggotaAuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;


Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');

Route::get('/books/by-category/{kategori}', 'PublicController@filterByCategory')->name('books.by_category');

Route::get('/', [BukuTamuUmumController::class, 'viewform'])->name('guestbook.view'); // This sets the guestbook page as the default route
// Keep the original guestbook route
Route::post('/guestbook', [BukuTamuUmumController::class, 'store'])->name('guestbook.store');

Route::get('/offline', [PublicController::class, 'showForm'])->name('peminjaman.form');
Route::post('/offline', [PublicController::class, 'pinjamBuku'])->name('peminjaman.pinjam');
Route::get('/cari-buku/{judulBuku}', 'PublicController@cariBukubyJudulBuku');
Route::get('/cari-buku/{id}/detail', 'PublicController@showDetail')->name('peminjaman.detail_buku');
Route::get('/search-buku/{judul}', [PublicController::class, 'searchByTitle']);

Route::get('/anggota/register', [AnggotaAuthController::class, 'showRegisterForm'])->name('anggota.register');
Route::post('/anggota/register', 'AnggotaAuthController@register');

//Anggota Login
Route::get('/anggota/login', 'AnggotaAuthController@showLoginForm')->name('anggota.login');
Route::post('/anggota/login', 'AnggotaAuthController@login');

Route::get('/semuabuku/cari', [PublicController::class, 'search'])->name('semuabuku.search');
Route::get('/perpustakaan', [PublicController::class, 'perpustakaan'])->name('perpustakaan');
Route::get('/semuabuku', [PublicController::class, 'semuabuku'])->name('semuabuku');
Route::get('/katalog', [PublicController::class, 'semuabuku'])->name('semuabuku');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');

Route::get('/cari-buku', [PublicController::class, 'searchBooks'])->name('cari-buku');


Route::post('/bukutamu-anggota/store', [BukuTamuAnggotaController::class, 'store'])->name('bukutamu_anggota.store');
Route::get('/getAnggotaInfo/{nomorAnggota}', [BukuTamuAnggotaController::class, 'getAnggotaInfo'])->name('bukutamu_anggota.getAnggotaInfo');

Route::post('/bukutamuanggota/store', [PublicController::class, 'storeAnggota'])->name('bukutamu_offline.store');
Route::get('/getAnggota/{nomorAnggota}', [PublicController::class, 'getAnggota'])->name('bukutamu_offline.getAnggotaInfo');
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

	// // Route::get('/dashboard', 'MemberDashboardController@index')->name('member.dashboard');
	// Route::post('/anggota/search-books', 'MemberDashboardController@searchBooks')->name('member.search.books');

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
	Route::get('/anggota/riwayat-peminjaman', 'AnggotaController@riwayatPeminjaman')->name('anggota.riwayat-peminjaman');

	//Logout Anggota
	Route::get('/anggota/logout', 'AnggotaAuthController@logout')->name('anggota.logout');
});
// Formulir Permintaan Peminjaman Buku
// Route::get('/anggota/buat-permintaan', [AnggotaController::class, 'buatPermintaan'])->name('anggota.buat-permintaan');
// Route::post('/anggota/simpan-permintaan', [AnggotaController::class, 'submitPermintaan'])->name('anggota.simpan-permintaan');
//Caribuku


// });




// Unauthenticated group 
Route::group(array('before' => 'guest'), function () {

	// CSRF protection 
	Route::group(array('before' => 'csrf'), function () {



		// Sign in (POST) 
		Route::post(
			'/sign-in',
			array(
				'as' => 'account-sign-in-post',
				'uses' => 'AccountController@postSignIn'
			)
		);
	});

	// Sign in (GET) 
	Route::get(
		'/signin',
		array(
			'as' => 'account-sign-in',
			'uses' => 'AccountController@getSignIn'
		)
	);





	// Render search books panel
	Route::get(
		'/book',
		array(
			'as' => 'search-book',
			'uses' => 'BooksController@searchBook'
		)
	);

	Route::post('book/create', [BooksController::class, 'store'])->name('book.store');
});

// Main books Controlller left public so that it could be used without logging in too
Route::resource('/books', 'BooksController');

// Authenticated group 
// Route::group(array('before' => 'auth'), function() {
Route::group(['middleware' => ['auth']], function () {

	// Create an account (POST) 
	Route::post(
		'/create',
		array(
			'as' => 'account-create-post',
			'uses' => 'AccountController@postCreate'
		)
	);

	// Create an account (GET) 
	Route::get(
		'/create',
		array(
			'as' => 'account-create',
			'uses' => 'AccountController@getCreate'
		)
	);
	// Home Page of Control Panel
	Route::get(
		'/home',
		array(
			'as' => 'home',
			'uses' => 'HomeController@home'
		)
	);

	// Render Add Books panel
	Route::get(
		'/add-books',
		array(
			'as' => 'add-books',
			'uses' => 'BooksController@renderAddBooks'
		)
	);

	Route::get(
		'/add-book-category',
		array(
			'as' => 'add-book-category',
			'uses' => 'BooksController@renderAddBookCategory'
		)
	);

	Route::post('/kategoribuku', 'BooksController@KategoriBukuStore')->name('bookcategory.store');


	// Render All Books panel
	Route::get(
		'/all-books',
		array(
			'as' => 'all-books',
			'uses' => 'BooksController@renderAllBooks'
		)
	);


	Route::get(
		'/bookBycategory/{cat_id}',
		array(
			'as' => 'bookBycategory',
			'uses' => 'BooksController@BookByCategory'
		)
	);


	Route::get('/list-anggota/add-member', 'AdminController@showAddMemberForm')->name('admin.tambah-anggota');
	Route::post('/list-anggota/add-member', 'AdminController@addMember')->name('admin.tambah-anggota.submit');
	Route::get('/list-anggota/{id}/edit', 'HomeController@editAnggota')->name('list-anggota-edit');
	Route::put('/list-anggota/{id}', 'HomeController@updateAnggota')->name('list-anggota-updateAnggota');

	// List Anggota
	Route::get('/list-anggota', [HomeController::class, 'listAnggota'])->name('list-anggota');
	Route::get('/list-anggota/{id}', [HomeController::class, 'showAnggota'])->name('list-anggota-detail');

	Route::delete('/list-anggota/{id}', [HomeController::class, 'destroy'])->name('list-anggota-delete');

	Route::get('/admin/profile', 'HomeController@showProfile')->name('admin.profile');
	Route::get('/admin/profile/change-password', [HomeController::class, 'showChangePasswordForm'])->name('admin.profile.change-password');
	Route::post('/admin/profile/change-password', [HomeController::class, 'changePassword'])->name('admin.profile.change-password.post');

	Route::get('/kelola-galeri', [GaleriController::class, 'manage'])->name('galeri.manage');

	Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
	Route::post('/galeri/store', 'GaleriController@store')->name('galeri.store');


	Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');

	// Route untuk menyimpan perubahan galeri yang sudah diedit
	Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
	Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
	Route::get('/galeri/{id}', 'GaleriController@show')->name('galeri.show');



	// Render Guestbook View
	Route::get('/bukutamu-umum', [BukuTamuUmumController::class, 'viewbukutamuumum'])->name('bukutamuumum.view');
	Route::get('/bukutamu', [BukuTamuUmumController::class, 'viewbukutamu'])->name('bukutamu.view');
	// Update Buku
	Route::get('/books/{id}/edit', 'BooksController@edit')->name('books.edit');
	Route::put('/books/{id}', [BooksController::class, 'update'])->name('books.update');

	Route::post('/buku-tidak-aktif/{id}/activate', [BooksController::class, 'activateBook'])->name('books.activate');
	Route::post('/books/{id}/deactivate', [BooksController::class, 'deactivateBook'])->name('books.deactivate');

	Route::get('/buku-tidak-aktif', 'BooksController@bukutidakaktif')->name('tidakaktif.index');

	Route::get('/bukutamu-anggota', [BukutamuAnggotaController::class, 'index'])->name('bukutamuanggota.view');
	//Detail Buku
	Route::get('/books/{id}/detail', 'BooksController@showDetail')->name('books.detail');
	Route::get('/home/{id}/detail', 'HomeController@showDetail')->name('buku.detail');

	//Hapus Buku
	Route::delete('/all-books/{id}/delete', 'BooksController@destroyBook')->name('books.destroy');

	Route::get('/peminjaman/daftar', [PeminjamanBukuController::class, 'daftarPermintaanPeminjaman'])->name('admin.peminjaman.daftar');

	// Menyetujui permintaan peminjaman
	Route::put('/peminjaman/approve/{id}', [PeminjamanBukuController::class, 'approve'])->name('admin.peminjaman.approve');
	Route::put('/admin/peminjaman/{id}/reject', [PeminjamanBukuController::class, 'reject'])->name('admin.peminjaman.reject');
	Route::put('/admin/peminjaman/{id}/kembalikan', [PeminjamanBukuController::class, 'kembalikanBukuAnggota'])->name('admin.peminjaman.kembalikan');


	Route::get('/verifikasi-anggota', 'AdminController@daftarnomoranggota')->name('verifikasi-anggota');


	//View Kembalikan Buku
	Route::get('/admin/buku-dikembalikan', [PeminjamanBukuController::class, 'bukuDikembalikan'])->name('admin.buku-dikembalikan');
	Route::get('/riwayat-peminjaman', [PeminjamanBukuController::class, 'bukuDikembalikan'])->name('riwayat-peminjaman');

	Route::get('/cari-anggota/{nomorAnggota}', 'AnggotaController@cariAnggotaByNomorAnggota');

	//Caribuku yang dipinjam

	Route::get('/find-issued-book/{nomorBuku}', 'BooksController@findBorrowedBook');
	Route::get('/search-books/{judulBuku}', 'BooksController@cariBukubyJudulBuku');
	Route::get('/admin/buku-dipinjam', [PeminjamanBukuController::class, 'bukuDipinjam'])->name('admin.buku-dipinjam');


	// Sign out (GET) 
	Route::get(
		'/sign-out',
		array(
			'as' => 'account-sign-out',
			'uses' => 'AccountController@getSignOut'
		)
	);
});
Auth::routes();
