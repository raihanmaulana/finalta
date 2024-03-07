@extends('layout.index')
@section('custom_top_script')
@stop

@section('content')
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Buku Tamu Anggota</h3>
            </div>
            <div class="module-body">

                <form class="mr-3" method="GET" action="{{ route('admin.bukutamuanggotaFilter') }}">


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
                            <th>Nomor Anggota</th>
                            <th>Nama Anggota</th>
                            <th>Kelas</th>
                            <th>Tanggal Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bukutamuAnggota as $bukutamu)
                            <tr>
                                <td>{{ $loop->iteration + $bukutamuAnggota->perPage() * ($bukutamuAnggota->currentPage() - 1) }}
                                </td>
                                <td>{{ $bukutamu->nomor_anggota }}</td>
                                <td>{{ $bukutamu->nama_anggota }}</td>
                                <td>{{ $bukutamu->kelas }}</td>
                                <td>{{ $bukutamu->created_at }}</td>
                            </tr>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Tampilkan pagination links -->
                {{ $bukutamuAnggota->links() }}

            </div>
        </div>
    </div>
@stop

@section('custom_bottom_script')
@stop
