@extends('layouts.app')

@section('content')
    <h1>Guestbook</h1>

    <form method="post" action="{{ route('guestbook.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea name="message" id="message" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Entry</button>
    </form>

    <hr>
    
    @foreach ($guests as $guest)
        <div class="guest-entry">
            <strong>{{ $guest->name }}</strong>
            <p>{{ $guest->message }}</p>
        </div>
    @endforeach
@endsection