@extends('layout.index')
@section('custom_top_script')
@stop

@section('content')
    <div class="content">
        <div class="btn-controls">
            <div class="btn-box-row row-fluid">
                <button class="btn-box span12" style="background: #025E9B; ">
                    <b style="color:#fff">Buku Tamu</b>
                </button>
            </div>

            <div class="btn-box-row row-fluid">
                <button class="btn-box big span6 homepage-form-box btn-hover" href="{{ URL::route('guestbook.view') }}">
                    <i class="icon-list" style="color: #025E9B"></i>
                    <b>Umum</b>
                </button>

                <button class="btn-box big span6 homepage-form-box btn-hover"
                    onclick="window.location.href='{{ URL::route('panel.bukutamuanggota') }}'">
                    <i class="icon-group" style="color: #025E9B"></i>
                    <b>Anggota</b>
                </button>
            </div>
            <div class="module">
                <div class="module-head">
                    <h3>Buku Tamu Umum</h3>
                </div>
                <div class="module-body">
                    <div class="controls">
                    </div>
                    @if (count($guests) > 0)
                        <table class="table table-striped table-bordered table-condensed">
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
