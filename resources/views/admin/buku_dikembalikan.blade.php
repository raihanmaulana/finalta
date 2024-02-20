@extends('layout.index')
@section('custom_top_script')
@stop

@section('content')

<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Riwayat Peminjaman</h3>
        </div>
        <div class="module-body">
            <div class="d-flex align-items-center mb-3">
                <!-- Input form untuk pencarian -->
                <form class="mr-3" method="GET" action="{{ route('riwayat-peminjaman') }}">
                    <div class="form-group d-flex align-items-center">
                        <label for="bulan" class="mr-2">Bulan</label>
                        <select class="form-control mr-3" id="bulan" name="bulan">
                            <option value="">Pilih Bulan</option>
                            @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                @endfor
                        </select>
                        <label for="tahun" class="mr-2">Tahun</label>
                        <select class="form-control mr-3" id="tahun" name="tahun">
                            <option value="">Pilih Tahun</option>
                            @for ($i = date('Y'); $i >= 2010; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>

                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Anggota</th>
                            <th>Nama Anggota</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bukuDikembalikan as $data)
                        <tr>
                            <td>{{ $loop->iteration + ($bukuDikembalikan->perPage() * ($bukuDikembalikan->currentPage() - 1)) }}</td>
                            <td>{{ $data->anggota->nomor_anggota }}</td>
                            <td>{{ $data->anggota->nama_anggota }}</td>
                            <td>{{ $data->buku->judul_buku }}</td>
                            <td>{{ $data->tanggal_peminjaman ? $data->tanggal_peminjaman->format('Y-m-d H:i:s') : 'Belum Dikembalikan' }}
                            </td>
                            <td>{{ $data->tanggal_pengembalian ? $data->tanggal_pengembalian->format('Y-m-d H:i:s') : 'Belum Dikembalikan' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Hilangkan kode berikut jika ingin menghapus pagination -->
                {{ $bukuDikembalikan->links() }}
            </div>
        </div>
    </div>
    @endsection