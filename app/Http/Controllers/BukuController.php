<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HomeController;
use App\Models\Buku;
use App\Models\PeminjamanBuku;
use App\Models\AnggotaPerpustakaan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Type;

class BukuController extends Controller
{
	protected $filter_params;

	public function __construct()
	{
		$this->filter_params = array('kategori_id');
		$this->kategori_list = Kategori::select()->orderBy('kategori')->get();
		$this->nomor_anggota = AnggotaPerpustakaan::select()->orderBy('nomor_anggota')->get();
		$this->judul_buku = Buku::select()->orderBy('judul_buku')->get();
		$this->isbn = PeminjamanBuku::select()->orderBy('isbn')->get();
	}

	public $kategori_list = array();
	public $nomor_anggota = array();
	public $judul_buku = array();
	public $isbn = array();

	public function create()
	{
		return view('panel.addbook')->with('kategori_list', $this->kategori_list);
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
		$request->validate([
			'isbn' => 'required', 'unique:buku,isbn',
			'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
		]);
		$imagePath = $request->file('image')->store('book_images', 'public');
		$book = Buku::create([
			'isbn' => $request->isbn,
			'judul_buku' => $request->judul_buku,
			'penerbit' => $request->penerbit,
			'pengarang' => $request->pengarang,
			'tahun_terbit' => $request->tahun_terbit,
			'deskripsi' => $request->deskripsi,
			'kategori_id' => $request->kategori_id,
			'stok' => $request->stok ?? 0,
			'added_by' => auth()->id(),
			'kondisi' => 1,
			'tautan_buku' => $request->tautan_buku,
			'image' => $imagePath,
		]);
		$book->hitungTersedia();
		return redirect('/kelola-buku')->with('success', 'Book and issues added successfully.');
	}

	public function KategoriBukuStore(Request $request)
	{
		$request->validate([
			'kategori' => 'required|unique:kategoribuku,kategori',
		]);

		// Create the category
		$kategori = Kategori::create([
			'kategori' => $request->kategori,
		]);

		// Redirect with success message
		return redirect()->route('add-book-category')->with('success', 'Kategori berhasil ditambahkan.');
	}


	public function edit($id)
	{
		$book = Buku::find($id);
		$categories_list = Kategori::all();
		return view('panel.editbook', compact('book', 'categories_list'));
	}

	public function update(Request $request, $id)
	{

		$book = Buku::find($id);
		$request->validate([
			'isbn'    => 'required',
			'judul_buku'    => 'required',
			'penerbit'      => 'required',
			'pengarang'     => 'required',
			'tahun_terbit'  => 'required|numeric',
			'deskripsi'  	=> 'required',
			'kategori_id'   => 'required|exists:kategoribuku,id',
			'stok'          => 'required|numeric',
			'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'tautan_buku'    => 'sometimes|nullable',
		]);

		if ($request->hasFile('image')) {
			$imagePath = $request->file('image')->store('book_images', 'public');
			$book->image = $imagePath;
		}

		$book->isbn = $request->isbn;
		$book->judul_buku = $request->judul_buku;
		$book->penerbit = $request->penerbit;
		$book->pengarang = $request->pengarang;
		$book->tahun_terbit = $request->tahun_terbit;
		$book->deskripsi = $request->deskripsi;
		$book->kategori_id = $request->kategori_id;
		$book->stok = $request->stok;
		$book->tautan_buku = $request->tautan_buku;
		$book->hitungTersedia();
		$book->save();

		return redirect('/kelola-buku')->with('success', 'Buku Berhasil Diperbarui.');
	}


	public function show($id)
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
	public function destroy($id)
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

	public function createKategori(Type $var = null)
	{
		return view('panel.addbookcategory');
	}

	public function index()
	{
		$kategoriBuku = Kategori::all();
		$tahunTerbit = Buku::distinct('tahun_terbit')->pluck('tahun_terbit');
		$books = Buku::all();
		return view('panel.allbook', compact('kategoriBuku', 'tahunTerbit', 'books'));
	}



	public function BookByCategory($cat_id)
	{
		$list_buku = Buku::select('id_buku', 'isbn', 'judul_buku', 'penerbit', 'pengarang', 'tahun_terbit', 'kategoribuku.kategori', 'stok')
			->join('kategoribuku', 'kategoribuku.id', '=', 'buku.kategori_id')
			->where('kategoribuku.id', $cat_id) // Use the correct table name
			->orderBy('id_buku')
			->get();

		foreach ($list_buku as $book) {
			$book->available = $this->calculateAvailableForBorrow($book->id_buku);
		}

		return $list_buku;
	}

	public function aktifkanBuku($id)
	{
		$book = Buku::findOrFail($id);
		$book->kondisi = true;
		$book->save();

		return redirect()->back()->with('success', 'Buku berhasil diaktifkan');
	}

	public function nonaktifkanBuku($id)
	{
		$book = Buku::findOrFail($id);
		$book->kondisi = false;
		$book->save();

		return redirect()->back()->with('success', 'Buku berhasil dinonaktifkan');
	}

	public function bukuNonaktif()
	{
		// Mengambil daftar buku yang tidak aktif
		$bukuTidakaktif = Buku::where('kondisi', 0)->get();
		$kategoriBuku = Kategori::all(); // Mengambil semua kategori buku
		// Mendapatkan daftar tahun terbit buku
		$tahunTerbit = Buku::distinct('tahun_terbit')->pluck('tahun_terbit');

		return view('admin.buku-tidak-aktif', compact('bukuTidakaktif', 'kategoriBuku', 'tahunTerbit'));
	}
}
