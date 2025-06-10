<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\KelasRequest;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan data program studi terakhir berdasarkan id_Kelas secara descending
        $lastKelas = Kelas::orderBy('id_kelas', 'desc')->first();

        // Jika ada data program studi terakhir, ambil angka berikutnya dari id_Kelas terakhir
        // dan hapus huruf 'K' pada awalnya, lalu tambahkan 1
        $nextCodeNumber = $lastKelas ? ((int) substr($lastKelas->id_kelas, 1) + 1) : 1;

        // Format kode Kelas dengan tiga digit, contoh: K001
        $newKodeKelas = 'K' . str_pad($nextCodeNumber, 3, '0', STR_PAD_LEFT);

        return view('admin.kelola-kelas.index', compact('newKodeKelas'));
    }

    /**
     * Store a newly created kelas in storage.
     *
     * @param  KelasRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(KelasRequest $request)
    {
        // Memvalidasi data yang dikirimkan melalui request menggunakan KelasRequest.
        // Jika validasi tidak terpenuhi, Laravel akan otomatis mengembalikan respon dengan pesan error.

        // Mendapatkan data yang telah divalidasi dari request.
        $inputDataKelas = $request->validated();

        // Membuat entitas Kelas baru dalam database menggunakan data yang telah divalidasi.
        Kelas::create($inputDataKelas);

        // Mengarahkan pengguna ke halaman 'kelola-kelas' setelah berhasil menambahkan kelas.
        // Sertakan pesan 'Berhasil menambahkan kelas' dalam session flash untuk ditampilkan pada halaman tujuan.
        return redirect()->route('admin.kelola-kelas')->with('success', 'Berhasil menambahkan kelas');
    }
}
