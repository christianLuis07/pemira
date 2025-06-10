<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\TahunAjarRequest;
use App\Models\TahunAjar;
use Illuminate\Http\Request;

class TahunAjarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data program studi dari database
        // $dataTahunAjar = TahunAjar::all();

        // Mendapatkan data program studi terakhir berdasarkan id_TahunAjar secara descending
        $lastTahunAjar = TahunAjar::orderBy('id_tahun_ajar', 'desc')->first();

        // Jika ada data program studi terakhir, ambil angka berikutnya dari id_TahunAjar terakhir
        // dan hapus huruf 'TA' pada awalnya, lalu tambahkan 1
        $nextCodeNumber = $lastTahunAjar ? ((int) substr($lastTahunAjar->id_tahun_ajar, 2) + 1) : 1;

        // Format kode TahunAjar dengan tiga digit, contoh: P001
        $newKodeTahunAjar = 'TA' . str_pad($nextCodeNumber, 3, '0', STR_PAD_LEFT);

        // Mengirim data program studi dan kode program studi baru ke view 'admin.kelola-TahunAjar.index'
        return view('admin.kelola-tahun.index', compact('newKodeTahunAjar'));
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
    public function store(TahunAjarRequest $request)
    {
        $inputData = $request->validated();
        TahunAjar::create($inputData);
        return redirect()->route('admin.kelola-tahun')->with('success', 'Berhasil menambahkan tahun ajaran');
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
