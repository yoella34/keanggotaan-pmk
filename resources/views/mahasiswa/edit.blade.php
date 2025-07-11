@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Mahasiswa</h1>

    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $mahasiswa->nama }}" required>
        </div>

        <div class="mb-3">
            <label>NIM</label>
            <input type="text" name="nim" class="form-control" value="{{ $mahasiswa->nim }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $mahasiswa->email }}" required>
        </div>

        <div class="mb-3">
            <label>Fakultas</label>
            <select name="fakultas" id="fakultas" class="form-control" required>
                @foreach($fakultas as $f)
                    <option value="{{ $f->nama }}" {{ $mahasiswa->fakultas->nama == $f->nama ? 'selected' : '' }}>
                        {{ $f->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jurusan</label>
            <select name="jurusan" id="jurusan" class="form-control" required>
                @foreach($jurusan as $j)
                    <option value="{{ $j->nama_jurusan }}" {{ $mahasiswa->jurusan->nama_jurusan == $j->nama_jurusan ? 'selected' : '' }}>
                        {{ $j->nama_jurusan }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

@push('scripts')
<!-- Tambahkan Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#fakultas').select2({
            tags: true,
            placeholder: "-- Pilih atau ketik fakultas --",
            allowClear: true
        });

        $('#jurusan').select2({
            tags: true,
            placeholder: "-- Pilih atau ketik jurusan --",
            allowClear: true
        });
    });
</script>
@endpush