@extends('layouts.app')

@section('title', 'Verifikasi Catatan')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Verifikasi Catatan</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row mt-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">NIP</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($daftarVerifikasi as $catatan)
                            <tr>
                                <td>{{ $catatan->NIP }}</td>
                                <td>{{ $catatan->Nama }}</td>
                                <td>{{ $catatan->Jabatan }}</td>
                                <td>{{ $catatan->Catatan }}</td>
                                <td>{{ $catatan->Tanggal }}</td>
                                <td>{{ $catatan->Status }}</td>
                                <td class="d-flex gap-2 flex-wrap">
                                    @if (Auth::user()->Jabatan === 'Kepala Dinas' || (Auth::user()->Jabatan === 'Kepala Bidang' && $catatan->Jabatan === 'Pegawai'))
                                        @if ($catatan->Status === 'Pending')
                                            <form action="{{ route('verifikasi.updateStatus', $catatan->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="Disetujui">
                                                <button type="submit" class="btn btn-success btn-sm">Setuju</button>
                                            </form>
                                            <form action="{{ route('verifikasi.updateStatus', $catatan->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="Ditolak">
                                                <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                            </form>
                                        @elseif($catatan->Status != 'Pending')
                                            <form action="{{ route('verifikasi.save', $catatan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin akan menyimpan catatan ini?')">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                            </form>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada catatan untuk diverifikasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
