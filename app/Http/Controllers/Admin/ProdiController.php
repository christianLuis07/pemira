<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ProdiRequest;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Menampilkan halaman daftar program studi (prodi).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua data program studi dari database
        $dataProdi = Prodi::all();

        // Mendapatkan data program studi terakhir berdasarkan id_prodi secara descending
        $lastProdi = Prodi::orderBy('id_prodi', 'desc')->first();

        // Jika ada data program studi terakhir, ambil angka berikutnya dari id_prodi terakhir
        // dan hapus huruf 'P' pada awalnya, lalu tambahkan 1
        $nextCodeNumber = $lastProdi ? ((int) substr($lastProdi->id_prodi, 1) + 1) : 1;

        // Format kode prodi dengan tiga digit, contoh: P001
        $newKodeProdi = 'P' . str_pad($nextCodeNumber, 3, '0', STR_PAD_LEFT);

        // Mengirim data program studi dan kode program studi baru ke view 'admin.kelola-prodi.index'
        return view('admin.kelola-prodi.index', compact('dataProdi', 'newKodeProdi'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdiRequest $request)
    {
        $inputDataProdi = $request->validated();

        Prodi::create($inputDataProdi);
        return redirect()->route('admin.kelola-prodi')->with('success', 'Berhasil menambahkan prodi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
