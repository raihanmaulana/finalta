<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HomeController;
use App\Models\Buku;
use App\Models\PeminjamanBuku;
use App\Models\Branch;
use App\Models\Issue;
use App\Models\Kategori;
use App\Models\Logs;
use App\Models\Student;
use App\Models\KategoriBuku;
use App\Models\StudentCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Mockery\Matcher\Type;
use Illuminate\Http\UploadedFile;

class BooksController extends Controller
{
	protected $filter_params;

	public function __construct()
	{

		$this->filter_params = array('kategori_id');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// ...
		$list_buku = Buku::select('id_buku', 'nomor_buku', 'judul_buku', 'penerbit', 'pengarang', 'tahun_terbit', 'stok', 'kategoribuku.kategori',)
			->join('kategoribuku', 'kategoribuku.id', '=', 'buku.kategori_id')
			->orderBy('id_buku')->get();

		// Loop melalui setiap buku dan tambahkan informasi available
		foreach ($list_buku as $book) {
			$book->available = $this->calculateAvailableForBorrow($book->id_buku);
		}

		return $list_buku;
	}

	protected function calculateAvailableForBorrow($bookId)
	{
		// Menghitung jumlah buku yang dipinjam
		$totalBorrowed = PeminjamanBuku::where('id_buku', '=', $bookId)->where('status', '=', 1)->count();

		// Mendapatkan stok buku
		$stok = Buku::where('id_buku', '=', $bookId)->value('stok');

		// Menghitung jumlah buku yang tersedia
		$available = max(0, $stok - $totalBorrowed);

		return $available;
	}




	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */


	public function store(Request $request)
	{
		$books = $request->all();
		$user_id = Auth::id();

		// Validate ISBN uniqueness
		$request->validate([
			'nomor_buku' => [
				'required',
				'unique:buku,nomor_buku', // Ensure nomor_buku is unique in the 'buku' table
			],
		]);

		// Get the latest id_buku
		$latestBook = Buku::latest('id_buku')->first();

		// Increment id_buku by 1
		$newId = $latestBook ? $latestBook->id_buku + 1 : 1;

		// Create the book
		$book = Buku::create([
			'id_buku'       => $newId, // Use the calculated id_buku
			'nomor_buku'    => $books['nomor_buku'] ?? null,
			'judul_buku'    => $books['judul_buku'] ?? null,
			'penerbit'      => $books['penerbit'] ?? null,
			'pengarang'     => $books['pengarang'] ?? null,
			'tahun_terbit'  => $books['tahun_terbit'] ?? null,
			'kategori_id'   => $books['kategori_id'] ?? null,
			'stok'         => $books['stok'] ?? 0, // Add this line
			'added_by'      => $user_id,
			'kondisi' => 1,
			'image'         => $books['image'] ?? null,

		]);
		if ($request->hasFile('image')) {
			$imagePath = $request->file('image')->store('book_images', 'public');
			$book->image = $imagePath;
		}


		$book->hitungTersedia();

		return redirect('/add-books')->with('success', 'Book and issues added successfully.');
	}



	public function KategoriBukuStore(Request $request)
	{
		$kategoris = $request->all();

		// Create the book
		$kategori = Kategori::create([
			'kategori'    => $kategoris['kategori'] ?? null,
		]);

		return redirect('/add-book-category')->with('success', 'Book and issues added successfully.');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	// public function show($string)
	// {
	// 	$list_buku = Buku::select('id_buku', 'nomor_buku', 'judul_buku', 'pengarang', 'tahun_terbit', 'kategoribuku.kategori', 'stok')
	// 		->join('kategoribuku', 'kategoribuku.id', '=', 'buku.kategori_id')
	// 		->where('judul_buku', 'like', '%' . $string . '%')
	// 		->orWhere('pengarang', 'like', '%' . $string . '%')
	// 		->orderBy('id_buku')
	// 		->get();

	// 	foreach ($list_buku as $book) {
	// 		$book->available = $this->calculateAvailableForBorrow($book->id_buku);
	// 		$book->status_buku = ($book->available > 0) ? 'Available' : 'Not Available';
	// 	}

	// 	return $list_buku;
	// }




	// File: BooksController.php

	public function edit($id)
	{
		$book = Buku::find($id);

		if ($book == NULL) {
			return view('error')->with('message', 'Invalid Book ID');
		}

		// Ambil data kategori untuk dropdown
		$categories_list = Kategori::all();

		return view('panel.editbook', compact('book', 'categories_list'));
	}

	public function update(Request $request, $id)
	{
		$book = Buku::find($id);

		if ($book == NULL) {
			return view('error')->with('message', 'Invalid Book ID');
		}

		// Validasi form input sesuai kebutuhan
		$request->validate([
			'nomor_buku'    => 'required',
			'judul_buku'    => 'required',
			'penerbit'      => 'required',
			'pengarang'     => 'required',
			'tahun_terbit'  => 'required|numeric',
			'kategori_id'   => 'required|exists:kategoribuku,id',
			'stok'          => 'required|numeric',
			'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);

		// Update book properties
		$book->nomor_buku = $request->input('nomor_buku');
		$book->judul_buku = $request->input('judul_buku');
		$book->penerbit = $request->input('penerbit');
		$book->pengarang = $request->input('pengarang');
		$book->tahun_terbit = $request->input('tahun_terbit');
		$book->kategori_id = $request->input('kategori_id');
		$book->stok = $request->input('stok');

		// Handle image upload
		if ($request->hasFile('image')) {
			$imagePath = $request->file('image')->store('book_images', 'public');
			$book->image = $imagePath;
			$book->hitungTersedia();
		}

		$book->hitungTersedia();

		$book->save();

		return redirect('/all-books')->with('success', 'Book updated successfully.');
	}


	public function showDetail($id)
	{
		$book = Buku::find($id);

		if ($book == NULL) {
			return view('error')->with('message', 'Invalid Book ID');
		}

		// Ambil data kategori untuk ditampilkan di detail
		$category = Kategori::find($book->kategori_id);

		return view('panel.bookdetail', compact('book', 'category'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroyBook($id)
	{
		$book = Buku::findOrFail($id);

		if ($book->delete()) {
			// Jika penghapusan berhasil, kirimkan respons JSON sukses
			return response()->json(['success' => true], 200);
		} else {
			// Jika terjadi kesalahan, kirimkan respons JSON gagal
			return response()->json(['success' => false], 500);
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function renderAddBookCategory(Type $var = null)
	{
		return view('panel.addbookcategory');
	}


	public function renderAddBooks()
	{
		$db_control = new HomeController();

		return view('panel.addbook')
			->with('kategori_list', $db_control->kategori_list);
	}

	public function renderAllBooks()
	{
		$kategoriBuku = Kategori::all(); // Mengambil semua kategori buku
		// Mendapatkan daftar tahun terbit buku
		$tahunTerbit = Buku::distinct('tahun_terbit')->pluck('tahun_terbit');
		$books = Buku::all(); // Misalnya Book adalah model yang merepresentasikan buku

		return view('panel.allbook', compact('kategoriBuku', 'tahunTerbit', 'books'));
	}


	public function findBorrowedBook($nomorBuku)
	{
		// Query untuk mendapatkan informasi peminjaman buku berdasarkan nomor buku
		$result = PeminjamanBuku::join('anggota_perpustakaan', 'peminjaman_buku.id_anggota', '=', 'anggota_perpustakaan.id_anggota')
			->join('buku', 'peminjaman_buku.id_buku', '=', 'buku.id_buku')
			->select('peminjaman_buku.nomor_buku', 'anggota_perpustakaan.nomor_anggota', 'anggota_perpustakaan.nama_anggota')
			->where('peminjaman_buku.nomor_buku', $nomorBuku)
			->where('peminjaman_buku.status', 1) // Hanya buku yang sedang dipinjam (status = 1)
			->get();

		return response()->json($result);
	}


	public function BookByCategory($cat_id)
	{
		$list_buku = Buku::select('id_buku', 'nomor_buku', 'judul_buku', 'penerbit', 'pengarang', 'tahun_terbit', 'kategoribuku.kategori', 'stok')
			->join('kategoribuku', 'kategoribuku.id', '=', 'buku.kategori_id')
			->where('kategoribuku.id', $cat_id) // Use the correct table name
			->orderBy('id_buku')
			->get();

		foreach ($list_buku as $book) {
			$book->available = $this->calculateAvailableForBorrow($book->id_buku);
		}

		return $list_buku;
	}

	public function activateBook($id)
	{
		$book = Buku::findOrFail($id);
		$book->kondisi = true;
		$book->save();

		return redirect()->back()->with('success', 'Buku berhasil diaktifkan');
	}

	public function deactivateBook($id)
	{
		$book = Buku::findOrFail($id);
		$book->kondisi = false;
		$book->save();

		return redirect()->back()->with('success', 'Buku berhasil dinonaktifkan');
	}


	// 	for ($i = 0; $i < count($list_buku); $i++) {

	// 		$id = $list_buku[$i]['id_buku'];
	// 		$conditions = array(
	// 			'id_buku'			=> $id,
	// 			'available_status'	=> 1
	// 		);

	// 		$list_buku[$i]['total_buku'] = Issue::select()
	// 			->where('book_id', '=', $id)
	// 			->count();

	// 		$list_buku[$i]['avaliable'] = Issue::select()
	// 			->where($conditions)
	// 			->count();
	// 	}



	// public function BookByCategory(Request $request)
	// {
	// 	$cat_id = $request->input('kategori_id');

	// 	$list_buku = Buku::select('id_buku', 'nomor_buku', 'judul_buku', 'penerbit', 'pengarang', 'kategoribuku.kategori')
	// 		->join('kategori_buku', 'kategori_buku.id', '=', 'buku.kategori_id')
	// 		->where('kategori_id', $cat_id)->orderBy('id_buku')
	// 		->get();

	// 	return $list_buku;
	// }

	public function cariBukuByJudulBuku($judulBuku)
	{
		// Menggunakan operator LIKE dengan wildcard (%) di awal dan akhir kata kunci
		$buku = Buku::with('kategori')->where('judul_buku', 'LIKE', '%' . $judulBuku . '%')->get();

		$formattedBooks = [];

		if ($buku->isNotEmpty()) {
			foreach ($buku as $item) {
				// Ambil nama kategori dari objek kategori
				$kategori = $item->kategori->kategori;

				$available = $this->calculateAvailableForBorrow($item->id_buku);
				// Buat format baru untuk buku termasuk nama kategori
				$formattedBooks[] = [
					'id_buku' => $item->id_buku,
					'nomor_buku' => $item->nomor_buku,
					'judul_buku' => $item->judul_buku,
					'pengarang' => $item->pengarang,
					'tahun_terbit' => $item->tahun_terbit,
					'kategori' => $kategori,
					'stok' => $item->stok,
					'tersedia' => $available
				];
			}
		}

		return response()->json($formattedBooks);
	}


	public function bukutidakaktif()
	{
		// Mengambil daftar buku yang tidak aktif
		$bukuTidakaktif = Buku::where('kondisi', 0)->get();
		$kategoriBuku = Kategori::all(); // Mengambil semua kategori buku
		// Mendapatkan daftar tahun terbit buku
		$tahunTerbit = Buku::distinct('tahun_terbit')->pluck('tahun_terbit');

		return view('admin.buku-tidak-aktif', compact('bukuTidakaktif', 'kategoriBuku', 'tahunTerbit'));
	}

	public function activate($id)
	{
		$book = Buku::findOrFail($id);
		$book->kondisi = 1;
		$book->save();

		return redirect()->route('inactive-books.index')->with('success', 'Buku berhasil diaktifkan.');
	}

	// public function searchBook()
	// {
	// 	$db_control = new HomeController();

	// 	return view('public.book-search')
	// 		->with('kategori_list', $db_control->kategori_list);
	// }
}
