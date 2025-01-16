@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <div class="row justify-content-between">
        <div class="col-md-8">
            <p>Hallo {{ Auth::user()->Jabatan }}, {{ Auth::user()->Nama }}</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('logs.create') }}" class="btn btn-primary">Buat Catatan</a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <table class="table table-hover table-responsive">  <thead>
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
                    @forelse ($daftarCatatan as $catatan)
                        <tr>
                            <td class="align-middle">{{ $catatan->NIP }}</td>
                            <td class="align-middle">{{ $catatan->Nama }}</td>
                            <td class="align-middle">{{ $catatan->Jabatan }}</td>
                            <td class="align-middle">{{ $catatan->Catatan }}</td>
                            <td class="align-middle">{{ $catatan->Tanggal }}</td>
                            <td class="align-middle">{{ $catatan->Status }}</td>
                            <td class="align-middle">
                                @if (Auth::user()->NIP === $catatan->NIP)
                                    @if ($catatan->Status === 'Pending')
                                        <form action="{{ route('logs.edit', $catatan->id) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-warning">Edit</button>
                                        </form>
                                        <form action="{{ route('logs.destroy', $catatan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin akan menghapus catatan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    @else
                                        <form action="{{ route('logs.submit', $catatan->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                        <form action="{{ route('logs.edit', $catatan->id) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-warning">Edit</button>
                                        </form>
                                        <form action="{{ route('logs.destroy', $catatan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin akan menghapus catatan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data log pegawai</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
