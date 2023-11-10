<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HomeController;
use App\Models\Buku;
use App\Models\Branch;
use App\Models\Issue;
use App\Models\Kategori;
use App\Models\Logs;
use App\Models\Student;
use App\Models\KategoriBuku;
use App\Models\StudentCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Type;

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

		$list_buku = Buku::select('id_buku', 'nomor_buku', 'judul_buku', 'penerbit', 'pengarang', 'tahun_terbit', 'kategoribuku.kategori')
			->join('kategoribuku', 'kategoribuku.id', '=', 'buku.kategori_id')
			->orderBy('id_buku')->get();
		// dd($list_buku);
		// $this->filterQuery($list_buku);

		// $list_buku = $list_buku->get();

		for ($i = 0; $i < count($list_buku); $i++) {

			$id = $list_buku[$i]['id_buku'];
			$conditions = array(
				'id_buku'			=> $id,
				'available_status'	=> 1
			);

			$list_buku[$i]['total_buku'] = Issue::select()
				->where('id_buku', '=', $id)
				->count();

			$list_buku[$i]['available'] = Issue::select()
				->where($conditions)
				->count();
		}

		return $list_buku;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
{
    $books = $request->all();
    $db_flag = false;
    $user_id = Auth::id();

    // Create the book
    $book = Buku::create([
        'nomor_buku'    => $books['nomor_buku'] ?? null,
        'judul_buku'    => $books['judul_buku'] ?? null,
        'penerbit'      => $books['penerbit'] ?? null,
        'pengarang'     => $books['pengarang'] ?? null,
        'tahun_terbit'  => $books['tahun_terbit'] ?? null,
        'kategori_id'   => $books['kategori_id'] ?? null,
        'added_by'      => $user_id,
    ]);

    if (!$book) {
        $db_flag = true;
    } else {
        // Check if 'number' key exists in $books array
        $number_of_issues = isset($books['number']) ? $books['number'] : 0;

        $newId = $book->id_buku;

        // Create the issues
        for ($i = 0; $i < $number_of_issues; $i++) {
            $issue = Issue::create([
                'id_buku'  => $newId,
                'added_by' => $user_id,
            ]);

            if (!$issue) {
                $db_flag = true;
            }
        }
    }

    // Handle $db_flag accordingly, e.g., redirect with error message
    if ($db_flag) {
        return redirect('/add-books')->with('error', 'Failed to add book or issues to the database.');
    } else {
        return redirect('/add-books')->with('success', 'Book and issues added successfully.');
    }
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
	public function show($string)
	{
		$list_buku = Buku::select('id_buku', 'nomor_buku', 'judul_buku', 'pengarang', 'tahun_terbit', 'kategoribuku.kategori')
			->join('kategoribuku', 'kategoribuku.id', '=', 'buku.kategori_id')
			->where('judul_buku', 'like', '%' . $string . '%')
			->orWhere('pengarang', 'like', '%' . $string . '%')
			->orderBy('id_buku');

		$list_buku = $list_buku->get();

		foreach ($list_buku as $book) {
			$conditions = array(
				'id_buku'			=> $book->id_buku,
				'available_status'	=> 1
			);

			$count = Issue::where($conditions)
				->count();

			$book->avaliability = ($count > 0) ? true : false;
		}

		return $list_buku;
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$issue = Issue::find($id);
		if ($issue == NULL) {
			return 'Invalid Book ID';
		}

		$book = Buku::find($issue->book_id);

		$issue->book_name = $book->title;
		$issue->author = $book->author;

		$issue->kategori = Kategori::find($book->kategori_id)
			->kategori;

		$issue->available_status = (bool)$issue->available_status;
		if ($issue->available_status == 1) {
			return $issue;
		}

		$conditions = array(
			'return_time'	=> 0,
			'book_issue_id'	=> $id,
		);
		$book_issue_log = Logs::where($conditions)
			->take(1)
			->get();

		foreach ($book_issue_log as $log) {
			$student_id = $log->student_id;
		}

		$student_data = Student::find($student_id);

		unset($student_data->email_id);
		unset($student_data->books_issued);
		unset($student_data->approved);
		unset($student_data->rejected);

		$student_branch = Branch::find($student_data->branch)
			->branch;
		$roll_num = $student_data->roll_num . '/' . $student_branch . '/' . substr($student_data->year, 2, 4);

		unset($student_data->roll_num);
		unset($student_data->branch);
		unset($student_data->year);

		$student_data->roll_num = $roll_num;

		$student_data->kategori = StudentCategories::find($student_data->category)
			->kategori;
		$issue->student = $student_data;


		return $issue;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

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
		$db_control = new HomeController();

		return view('panel.allbook')
			->with('kategori_list', $db_control->kategori_list);
	}

	public function BookByCategory($cat_id)
	{
		$list_buku = Buku::select('id_buku', 'nomor_buku', 'judul_buku', 'penerbit', 'pengarang', 'kategoribuku.kategori')
			->join('kategori_buku', 'kategori_buku.id', '=', 'buku.kategori_id')
			->where('kategori_id', $cat_id)->orderBy('id_buku');

		$list_buku = $list_buku->get();

		for ($i = 0; $i < count($list_buku); $i++) {

			$id = $list_buku[$i]['id_buku'];
			$conditions = array(
				'id_buku'			=> $id,
				'available_status'	=> 1
			);

			$list_buku[$i]['total_buku'] = Issue::select()
				->where('book_id', '=', $id)
				->count();

			$list_buku[$i]['avaliable'] = Issue::select()
				->where($conditions)
				->count();
		}

		return $list_buku;
	}

	public function searchBook()
	{
		$db_control = new HomeController();

		return view('public.book-search')
			->with('kategori_list', $db_control->kategori_list);
	}
}
