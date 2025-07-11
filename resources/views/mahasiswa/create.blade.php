@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Mahasiswa</h1>

    <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label>NIM</label>
            <input type="text" name="nim" class="form-control" value="{{ old('nim') }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label>Fakultas</label>
            <select name="fakultas" id="fakultas" class="form-control fakultas-select" required>
                <option value="">-- Pilih Fakultas --</option>
                @foreach($fakultas as $f)
                    <option value="{{ $f->nama }}">{{ $f->nama }}</option>
                @endforeach
            </select>
            <small class="text-muted">✅ Bisa pilih atau ketik Fakultas baru</small>
        </div>

        <div class="mb-3">
            <label>Jurusan</label>
            <select name="jurusan" id="jurusan" class="form-control jurusan-select" required>
                <option value="">-- Pilih Jurusan --</option>
                @foreach($jurusan as $j)
                    <option value="{{ $j->nama_jurusan }}">{{ $j->nama_jurusan }}</option>
                @endforeach
            </select>
            <small class="text-muted">✅ Bisa pilih atau ketik Jurusan baru</small>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

@push('scripts')
<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        // Enable Select2 with tagging (bisa ketik baru)
        $('.fakultas-select').select2({
            tags: true,
            placeholder: "Pilih atau ketik Fakultas"
        });

        $('.jurusan-select').select2({
            tags: true,
            placeholder: "Pilih atau ketik Jurusan"
        });
    });
</script>
@endpush