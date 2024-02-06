@extends('layout.index')
@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Buku Tamu Umum</h3>
        </div>
        <div class="module-body">
            <div class="controls">
            </div>
            @if (count($guests) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guests as $index => $guest)
                    <tr>
                        <td>{{ $guest->id }}</td>
                        <td>{{ $guest->name }}</td>
                        <td>{{ $guest->message }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Tampilkan pagination links -->
            {{ $guests->links() }}
            @else
            <p>No guestbook entries found.</p>
            @endif
        </div>
    </div>
</div>
@stop

@section('custom_bottom_script')
@stop