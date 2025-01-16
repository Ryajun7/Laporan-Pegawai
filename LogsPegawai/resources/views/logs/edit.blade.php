@extends('layouts.app')

@section('title', 'Edit Catatan')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Catatan</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('logs.update', $log->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="Catatan" class="form-label">Catatan</label>
            <textarea class="form-control" id="Catatan" name="Catatan" rows="3" required>{{ old('Catatan', $log->Catatan) }}</textarea>
            @error('Catatan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="Tanggal" name="Tanggal" value="{{ old('Tanggal', $log->Tanggal) }}" required>
            @error('Tanggal')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
