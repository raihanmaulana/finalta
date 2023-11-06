<!-- @extends('layouts.app')

@section('content')
<h1>Data Buku Tamu</h1>

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Pesan</th>
            <th>Waktu</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($guestbookEntries as $entry)
        <tr>
            <td>{{ $entry->name }}</td>
            <td>{{ $entry->message }}</td>
            <td>{{ $entry->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection -->