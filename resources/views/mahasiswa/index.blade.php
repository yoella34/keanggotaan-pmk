@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Sistem Keanggotaan PMK</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <form action="{{ route('mahasiswa.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari nama atau NIM..." value="{{ request('search') }}">
            <button class="btn btn-primary">Cari</button>
        </form>
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-success">+ Tambah Mahasiswa</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>Jurusan</th>
                <th>Fakultas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mahasiswa as $mhs)
            <tr>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->email }}</td>
                <td>
                    <input type="text" 
                           value="{{ $mhs->jurusan->nama_jurusan ?? '-' }}" 
                           class="form-control form-control-sm edit-field" 
                           data-id="{{ $mhs->id }}" 
                           data-field="jurusan">
                </td>
                <td>
                    <input type="text" 
                           value="{{ $mhs->fakultas->nama ?? '-' }}" 
                           class="form-control form-control-sm edit-field" 
                           data-id="{{ $mhs->id }}" 
                           data-field="fakultas">
                </td>
                <td>
                    <a href="{{ route('mahasiswa.show', $mhs->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data mahasiswa.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $mahasiswa->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        $('.edit-field').on('change', function() {
            let id = $(this).data('id');
            let field = $(this).data('field');
            let value = $(this).val();

            $.ajax({
                url: '{{ route("mahasiswa.updateField") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    field: field,
                    value: value
                },
                success: function(response) {
                    if (response.success) {
                        alert('Berhasil update ' + field);
                    } else {
                        alert('Gagal update');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat menyimpan.');
                }
            });
        });
    });
</script>
@endpush