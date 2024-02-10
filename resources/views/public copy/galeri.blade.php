@extends('layouts.layout')


@section('customcss')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Homepage</title>
    <link rel="stylesheet" href="/css/dashboard.css">
</head>

@endsection

@section('content')
<div class="container">
    <div class="box">
        <div class="dream">
            <img src="{{ asset('css\images\130x190.png') }}" />
            <img src="{{ asset('css\images\130x190.png') }}" />
            <img src="{{ asset('css\images\130x190.png') }}" />
            <img src="{{ asset('css\images\130x190.png') }}" />
            <img src="{{ asset('css\images\130x190.png') }}" />
        </div>

        <div class="dream">
            <img src="{{ asset('css\images\130x190.png') }}" />
            <img src="{{ asset('css\images\130x190.png') }}" />
            <img src="{{ asset('css\images\130x190.png') }}" />
            <img src="{{ asset('css\images\130x190.png') }}" />
            <img src="{{ asset('css\images\130x190.png') }}" />
        </div>

        <div class="dream">
            <img src="{{ asset('css\images\130x190.png') }}" />
            <img src="{{ asset('css\images\130x190.png') }}" />
            <img src="{{ asset('css\images\130x190.png') }}" />
            <img src="{{ asset('css\images\130x190.png') }}" />
            <img src="{{ asset('css\images\130x190.png') }}" />
        </div>
    </div>
    <div class="btn">
        <a href="#">More</a>
    </div>
</div>

@endsection