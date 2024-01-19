<!-- resources/views/guestbook/admin-view.blade.php -->

@extends('account.layout')
@section('index')

<h1>Guestbook Entries</h1>

@if (count($guests) > 0)
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($guests as $guest)
        <tr>
            <td>{{ $guest->name }}</td>
            <td>{{ $guest->message }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>No guestbook entries found.</p>
@endif
@endsection