<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Exception;

class AccountController extends Controller
{
	### Sign In
	/* After submitting the sign-in form */
	public function postSignIn(Request $request)
	{
		$validator = $request->validate([
			'username' 	=> 'required',
			'password'	=> 'required'

		]);
		if (!$validator) {
			// Redirect to the sign in page
			return Redirect::route('account-sign-in')
				->withErrors($validator)
				->withInput();   // redirect the input

		} else {

			$remember = ($request->has('remember')) ? true : false;
			$auth = Auth::attempt(array(
				'username' => $request->get('username'),
				'password' => $request->get('password')
			), $remember);
		}

		if ($auth) {

			return Redirect::intended('home');
		} else {

			return Redirect::route('account-sign-in')
				->with('global', 'Wrong Email or Wrong Password.');
		}
	}

	/* Submitting the Create User form (POST) */
	public function postCreate(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'nama'            => 'required|max:255',
			'username'        => 'required|max:20|min:3|unique:users',
			'email'           => 'required|email|unique:users',
			'password'        => 'required|min:8',
			'password_again'  => 'required|same:password',
		]);

		if ($validator->fails()) {
			return Redirect::route('account-create')
				->withErrors($validator)
				->withInput();   // fills the field with the old inputs what were correct
		}

		// create an account
		$username = $request->get('username');
		$password = $request->get('password');
		$email    = $request->get('email');
		$nama     = $request->get('nama');

		$user = User::create([
			'username' => $username,
			'email'    => $email,
			'password' => Hash::make($password),
			'nama'     => $nama,
		]);

		if ($user) {
			return redirect()->route('account-sign-in')->with('success', 'Akun Berhasil Dibuat.');
		} else {
			return redirect()->route('account-sign-in')->with('false', 'Akun Gagal Dibuat.');
		}
	}


	public function getSignIn()
	{
		return view('account.index');
	}

	/* Viewing the form (GET) */
	public function getCreate()
	{
		return view('account.create');
	}

	### Sign Out
	public function getSignOut()
	{
		Auth::logout();
		return Redirect::route('account-sign-in');
	}
}
