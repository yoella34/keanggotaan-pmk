@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Mahasiswa</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
            <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
            <p><strong>Email:</strong> {{ $mahasiswa->email }}</p>
            <p><strong>Fakultas:</strong> {{ $mahasiswa->fakultas->nama }}</p>
            <p><strong>Jurusan:</strong> {{ $mahasiswa->jurusan->nama_jurusan }}</p>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
