<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Fakultas;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Tampilkan daftar mahasiswa
     */
    public function index(Request $request)
    {
        $query = Mahasiswa::with(['jurusan', 'fakultas']); // eager loading

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
        }

        $mahasiswa = $query->paginate(10);

        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Tampilkan form tambah mahasiswa
     */
    public function create()
    {
        $fakultas = Fakultas::all();
        $jurusan = Jurusan::all();
        return view('mahasiswa.create', compact('fakultas', 'jurusan'));
    }

    /**
     * Simpan data mahasiswa baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:mahasiswas,nim',
            'email' => 'required|email|unique:mahasiswas,email',
            'jurusan' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
        ]);

        // Cek atau buat fakultas baru
        $fakultas = Fakultas::firstOrCreate(['nama' => $request->fakultas]);

        // Cek atau buat jurusan baru
        $jurusan = Jurusan::firstOrCreate(
            ['nama_jurusan' => $request->jurusan],
            ['fakultas_id' => $fakultas->id]
        );

        // Simpan data mahasiswa
        Mahasiswa::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan_id' => $jurusan->id,
            'fakultas_id' => $fakultas->id,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit mahasiswa
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $fakultas = Fakultas::all();
        $jurusan = Jurusan::where('fakultas_id', $mahasiswa->fakultas_id)->get();

        return view('mahasiswa.edit', compact('mahasiswa', 'fakultas', 'jurusan'));
    }

    /**
     * Simpan perubahan data mahasiswa
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:mahasiswas,nim,' . $mahasiswa->id,
            'email' => 'required|email|unique:mahasiswas,email,' . $mahasiswa->id,
            'jurusan' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
        ]);

        // Cek atau buat fakultas baru
        $fakultas = Fakultas::firstOrCreate(['nama' => $request->fakultas]);

        // Cek atau buat jurusan baru
        $jurusan = Jurusan::firstOrCreate(
            ['nama_jurusan' => $request->jurusan],
            ['fakultas_id' => $fakultas->id]
        );

        // Update mahasiswa
        $mahasiswa->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan_id' => $jurusan->id,
            'fakultas_id' => $fakultas->id,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Hapus mahasiswa
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    /**
     * AJAX - Update jurusan/fakultas langsung di tabel
     */
    public function updateField(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:mahasiswas,id',
            'field' => 'required|in:jurusan,fakultas',
            'value' => 'required|string|max:255',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($request->id);

        if ($request->field === 'jurusan') {
            $jurusan = Jurusan::firstOrCreate(['nama_jurusan' => $request->value]);
            $mahasiswa->jurusan_id = $jurusan->id;
            $mahasiswa->fakultas_id = $jurusan->fakultas_id; // ikut update fakultas
        } elseif ($request->field === 'fakultas') {
            $fakultas = Fakultas::firstOrCreate(['nama' => $request->value]);
            $mahasiswa->fakultas_id = $fakultas->id;
        }

        $mahasiswa->save();

        return response()->json(['success' => true]);
    }

    /**
     * AJAX - Get jurusan berdasarkan fakultas
     */
    public function getJurusan($fakultas_id)
    {
        $jurusan = Jurusan::where('fakultas_id', $fakultas_id)->get();
        return response()->json($jurusan);
    }
}