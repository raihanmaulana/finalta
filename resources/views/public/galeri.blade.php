@extends('public.index')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/utama/galeri.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
@endsection
@section('content')
    <div class="container">
        <div class="box">
            <div class="dream">
                @forelse ($galeri1 as $row)
                    <img src="{{ asset('uploads/' . $row->gambar_galeri) }}" />
                @empty
                @endforelse
            </div>
            <div class="dream">
                @forelse ($galeri2 as $row)
                    <img src="{{ asset('uploads/' . $row->gambar_galeri) }}" />
                @empty
                @endforelse
            </div>
            <div class="dream">
                @forelse ($galeri3 as $row)
                    <img src="{{ asset('uploads/' . $row->gambar_galeri) }}" />
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection
