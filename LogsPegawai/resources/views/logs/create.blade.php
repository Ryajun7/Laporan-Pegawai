@extends('layouts.app')

@section('title', 'Buat Catatan Harian')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Buat Catatan Harian</h1>
    </div>

    <form action="{{ route('logs.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="NIP" class="form-label">NIP</label>
            <input type="text" class="form-control" id="NIP" name="NIP" value="{{ Auth::user()->NIP }}" disabled>
        </div>

        <div class="mb-3">
            <label for="Nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="Nama" name="Nama" value="{{ Auth::user()->Nama }}" disabled>
        </div>

        <div class="mb-3">
            <label for="Jabatan" class="form-label">Jabatan</label>
            <input type="text" class="form-control" id="Jabatan" name="Jabatan" value="{{ Auth::user()->Jabatan }}" disabled>
        </div>

        <div class="mb-3">
            <label for="Catatan" class="form-label">Catatan</label>
            <textarea class="form-control" id="Catatan" name="Catatan" rows="3" required></textarea>
            @error('Catatan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
