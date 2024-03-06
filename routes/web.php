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

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OfflineController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PeminjamanBukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\AnggotaAuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;


// Landing Page
Route::get('/', [PublicController::class, 'landingpage'])->name('bukutamu.view');
Route::post('/bukutamu-umum/store', [BukuTamuController::class, 'storeUmum'])->name('bukutamu.store');
Route::post('/bukutamu-anggota/store', [BukuTamuController::class, 'storeAnggota'])->name('bukutamu_anggota.store');
Route::get('/getAnggotaInfo/{nomorAnggota}', [BukuTamuController::class, 'getAnggotaInfo'])->name('bukutamu_anggota.getAnggotaInfo');

// Offline
Route::get('/offline', [OfflineController::class, 'showForm'])->name('peminjaman.form');
Route::post('/offline', [OfflineController::class, 'pinjamBuku'])->name('peminjaman.pinjam');
Route::get('/offline/cari-buku/{judulBuku}', [OfflineController::class, 'cariBukubyJudulBuku']);
Route::get('/offline/cari-buku/{id}/detail', [OfflineController::class, 'showDetail'])->name('peminjaman.detail_buku');
Route::post('/bukutamuanggota/store', [OfflineController::class, 'storeBukuTamuAnggota'])->name('bukutamu_offline.store');
Route::get('/getAnggota/{nomorAnggota}', [OfflineController::class, 'getAnggota'])->name('bukutamu_offline.getAnggotaInfo');

// Public
Route::get('/perpustakaan', [PublicController::class, 'perpustakaan'])->name('perpustakaan');
Route::get('/semuabuku', [PublicController::class, 'semuabuku'])->name('semuabuku');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');
Route::get('/books/by-category/{kategori}', [PublicController::class, 'filterByCategory'])->name('books.by_category');
Route::get('/search-buku/{judul}', [PublicController::class, 'searchByTitle']);

// Register dan Login Anggota
Route::get('/anggota/register', [AnggotaAuthController::class, 'showRegisterForm'])->name('anggota.register');
Route::post('/anggota/register', 'AnggotaAuthController@register');
Route::get('/anggota/login', 'AnggotaAuthController@showLoginForm')->name('anggota.login');
Route::post('/anggota/login', 'AnggotaAuthController@login');

//Middleware Untuk Anggota Perpustakaan
Route::middleware(['auth:anggota', 'anggota'])->group(function () {
	//Halaman Anggota
	Route::get('/anggota/dashboard', [AnggotaAuthController::class, 'dashboard'])->name('anggota.dashboard');

	//Edit Profil
	Route::get('/edit-profil/{id}', [AnggotaController::class, 'editProfile'])->name('edit_profil');
	Route::post('/update-profil/{id}', [AnggotaController::class, 'updateProfile'])->name('update_profil');

	//Peminjaman Buku Anggota
	Route::get('/anggota/peminjaman', [AnggotaController::class, 'showPeminjamanForm'])->name('anggota.peminjaman.form');
	Route::get('/anggota/list', [AnggotaController::class, 'showPeminjamanDaftar'])->name('anggota.list');
	Route::post('/anggota/peminjaman', [AnggotaController::class, 'peminjamanStore'])->name('anggota.peminjaman.store');
	Route::get('/anggota/riwayat-peminjaman', [AnggotaController::class, 'riwayatPeminjaman'])->name('anggota.riwayat-peminjaman');

	//Profile Anggota
	Route::get('/anggota/profile', 'AnggotaController@showProfile')->name('anggota.profile');
	Route::get('/anggota/profile/change-password', [AnggotaController::class, 'showChangePasswordForm'])->name('anggota.profile.change-password');
	Route::post('/anggota/profile/change-password', [AnggotaController::class, 'changePassword'])->name('anggota.profile.change-password.post');

	//Logout Anggota
	Route::get('/anggota/logout', 'AnggotaAuthController@logout')->name('anggota.logout');
});


// Unauthenticated group 
Route::group(['middleware' => 'guest'], function () {

	// CSRF protection 
	Route::group(['middleware' => 'web'], function () {
		// Sign in (POST) 
		Route::post('/sign-in', [AccountController::class, 'postSignIn'])
			->name('account-sign-in-post');
	});

	// Sign in (GET) 
	Route::get('/sign-in', [AccountController::class, 'getSignIn'])
		->name('account-sign-in');
});



Route::group(['middleware' => ['auth']], function () {

	// Create an account (POST) 
	Route::post('/create', [AccountController::class, 'postCreate'])
		->name('account-create-post');

	// Create an account (GET) 
	Route::get('/create', [AccountController::class, 'getCreate'])
		->name('account-create');





	// Halaman Home
	Route::get('/home', [HomeController::class, 'home'])->name('home');
	Route::get('/home/{id}/detail', [HomeController::class, 'showDetail'])->name('buku.detail');

	//Profile Admin
	Route::get('/admin/profile', [AdminController::class, 'showProfile'])->name('admin.profile');
	Route::get('/admin/profile/change-password', [AdminController::class, 'showChangePasswordForm'])->name('admin.profile.change-password');
	Route::post('/admin/profile/change-password', [AdminController::class, 'changePassword'])->name('admin.profile.change-password.post');

	//Verifikasi dan Kelola Anggota
	Route::get('/list-anggota/add-member', [AdminController::class, 'create'])->name('admin.tambah-anggota');
	Route::post('/list-anggota/add-member', [AdminController::class, 'store'])->name('admin.tambah-anggota.submit');
	Route::get('/list-anggota/verifikasi', [AdminController::class, 'verifikasiAnggota'])->name('verifikasi-anggota');
	Route::get('/list-anggota', [AdminController::class, 'index'])->name('list-anggota');
	Route::get('/list-anggota/{id}', [AdminController::class, 'show'])->name('list-anggota-detail');
	Route::get('/list-anggota/{id}/edit', [AdminController::class, 'edit'])->name('list-anggota-edit');
	Route::put('/list-anggota/{id}', [AdminController::class, 'update'])->name('list-anggota-updateAnggota');
	Route::delete('/list-anggota/{id}', [AdminController::class, 'destroy'])->name('list-anggota-delete');




	//Kelola Galeri
	Route::get('/galeri/kelola', [GaleriController::class, 'manage'])->name('galeri.manage');
	Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
	Route::post('/galeri/store', [GaleriController::class, 'store'])->name('galeri.store');
	Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
	Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
	Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
	Route::get('/galeri/{id}', [GaleriController::class, 'show'])->name('galeri.show');


	//Kelola BukuTamu Umum
	Route::get('/bukutamu-umum', [BukuTamuController::class, 'bukuTamuUmum'])->name('bukutamuumum.view');
	Route::get('/bukutamu', [BukuTamuController::class, 'viewBukuTamu'])->name('bukutamu.view');
	Route::get('/bukutamu-anggota', [BukutamuController::class, 'bukuTamuAnggota'])->name('bukutamuanggota.view');
	Route::get('/bukutamu-umum/filter', [BukuTamuController::class, 'bukutamuumumFilter'])->name('admin.bukutamuumumFilter');
	Route::get('/bukutamu-anggota/filter', [BukuTamuController::class, 'bukutamuanggotaFilter'])->name('admin.bukutamuanggotaFilter');

	// Kelola Buku
	Route::get('/kelola-buku', [BukuController::class, 'index'])->name('all-books');
	Route::get('/kelola-buku/tambah', [BukuController::class, 'create'])->name('add-books');
	Route::post('/kelola-buku/tambah', [BukuController::class, 'store'])->name('book.store');
	Route::get('/kelola-buku/tambah-kategori', [BukuController::class, 'createKategori'])->name('add-book-category');
	Route::post('/kelola-buku/tambah-kategori', [BukuController::class, 'KategoriBukuStore'])->name('bookcategory.store');
	Route::get('/kelola-buku/{id}/edit', [BukuController::class, 'edit'])->name('books.edit');
	Route::put('/kelola-buku/{id}', [BukuController::class, 'update'])->name('books.update');
	Route::post('/kelola-buku/{id}/activate', [BukuController::class, 'aktifkanBuku'])->name('books.activate');
	Route::post('/kelola-buku/{id}/deactivate', [BukuController::class, 'nonaktifkanBuku'])->name('books.deactivate');
	Route::get('/kelola-buku/nonaktif', [BukuController::class, 'bukuNonaktif'])->name('tidakaktif.index');
	Route::get('/kelola-buku/{id}/detail', [BukuController::class, 'show'])->name('books.detail');
	// Route::delete('/kelola-buku/{id}/delete', 'BooksController@destroyBook')->name('books.destroy');


	//Kelola Peminjaman
	Route::get('/peminjaman/permintaan', [PeminjamanBukuController::class, 'daftarPermintaanPeminjaman'])->name('admin.peminjaman.daftar');
	Route::put('/peminjaman/{id}/setujuiPeminjaman', [PeminjamanBukuController::class, 'setujuiPeminjaman'])->name('admin.peminjaman.approve');
	Route::put('/peminjaman/{id}/tolakPeminjaman', [PeminjamanBukuController::class, 'tolakPeminjaman'])->name('admin.peminjaman.reject');
	Route::put('/peminjaman/{id}/kembalikan', [PeminjamanBukuController::class, 'kembalikanBukuAnggota'])->name('admin.peminjaman.kembalikan');
	Route::get('/peminjaman/buku-dipinjam', [PeminjamanBukuController::class, 'bukuDipinjam'])->name('admin.buku-dipinjam');
	Route::get('/peminjaman/buku-dikembalikan', [PeminjamanBukuController::class, 'bukuDikembalikan'])->name('admin.buku-dikembalikan');


	//Kelola Home (index)
	Route::get('/cari-anggota/{nomorAnggota}', 'AnggotaController@cariAnggotaByNomorAnggota');
	Route::get('/find-issued-book/{nomorBuku}', 'BooksController@findBorrowedBook');
	Route::get('/search-books/{judulBuku}', 'BooksController@cariBukubyJudulBuku');


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
