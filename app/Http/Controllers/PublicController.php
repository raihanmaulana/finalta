<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function perpustakaan()
    {
        return view('public.perpustakaan');
    }
}
