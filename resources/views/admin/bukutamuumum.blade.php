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
                <form class="mr-3" method="GET" action="{{ route('admin.bukutamuumumFilter') }}">


                    <select class="form-control mr-3" id="bulan" name="bulan">
                        <option value="">Pilih Bulan</option>
                        @php
                            $namaBulan = [
                                'Januari',
                                'Februari',
                                'Maret',
                                'April',
                                'Mei',
                                'Juni',
                                'Juli',
                                'Agustus',
                                'September',
                                'Oktober',
                                'November',
                                'Desember',
                            ];
                        @endphp
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ $namaBulan[$i - 1] }}</option>
                        @endfor
                    </select>



                    <select class="form-control mr-3" id="tahun" name="tahun">
                        <option value="">Pilih Tahun</option>
                        @for ($i = date('Y'); $i >= 2010; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-primary">Cari</button>

                </form>

                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Asal Daerah</th>
                            <th>Tanggal Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bukutamu_umum as $guest)
                            <tr>
                                <td>{{ $loop->iteration + $bukutamu_umum->perPage() * ($bukutamu_umum->currentPage() - 1) }}
                                </td>
                                <td>{{ $guest->nama }}</td>
                                <td>{{ $guest->asal_daerah }}</td>
                                <td>{{ $guest->created_at->format('d-m-Y H:i:s') }}</td>
                            </tr>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $bukutamu_umum->links() }}

                {{-- @if (count($bukutamu_umum) > 0)
                    <table class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Asal Daerah</th>
                                <th>Tanggal Kunjungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Hitung nomor urut untuk tabel bukutamu
                                $currentPage = $bukutamu_umum->currentPage();
                                $perPage = $bukutamu_umum->perPage();
                                $startNumber = ($currentPage - 1) * $perPage + 1;
                            @endphp
                            @foreach ($bukutamu_umum as $index => $guest)
                                <tr>
                                    <td>{{ $startNumber + $index }}</td> <!-- Tambahkan nomor urut disini -->
                                    <td>{{ $guest->nama }}</td>
                                    <td>{{ $guest->asal_daerah }}</td>
                                    <td>{{ $guest->created_at->format('d-m-Y H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Tampilkan pagination links -->
                    {{ $bukutamu_umum->links() }}
                @else
                    <p>No guestbook entries found.</p>
                @endif --}}
            </div>
        </div>
    </div>
@stop

@section('custom_bottom_script')
@stop
