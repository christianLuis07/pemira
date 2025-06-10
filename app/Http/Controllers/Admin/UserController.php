<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UserRequest;
use App\Models\DetailUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Menampilkan halaman daftar user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil data semua user dari database menggunakan model User dan fungsi all(),
        // kecuali data user yang ber id = 1 / Admin.
        $dataUser = User::where('id', '<>', '1')->get();

        // Mengirimkan data user ke halaman admin.kelola-user.index menggunakan compact().
        return view('admin.kelola-user.index', compact('dataUser'));
    }

    /**
     * Menampilkan halaman form untuk membuat user baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Mengirimkan view admin.kelola-user.create ke halaman untuk menampilkan form pembuatan user baru.
        return view('admin.kelola-user.create');
    }

    /**
     * Menyimpan user baru ke dalam database.
     *
     * @param \App\Http\Requests\UserRequest $request Request data user dari form pembuatan user baru.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        // Memvalidasi data request menggunakan class UserRequest yang berisi aturan validasi.
        // Jika validasi gagal, Laravel akan secara otomatis mengembalikan response dengan pesan error yang sesuai.
        $request->validated();

        // Mendapatkan ID user terakhir berdasarkan kolom 'id' secara menurun (DESC) menggunakan model User.
        $lastUser = User::orderBy('id', 'DESC')->first();

        // Menambahkan 1 ke ID user terakhir untuk mendapatkan ID baru.
        $newId = $lastUser->id + 1;

        // Menyimpan data user baru ke dalam database menggunakan model User dan fungsi create().
        $user = User::create([
            'id' => $newId,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Membuat data DetailUser baru dengan mengisi 'user_id' dengan ID baru yang telah dibuat sebelumnya.
        DetailUser::create([
            'user_id' => $user->id
        ]);

        // Mengalihkan user ke halaman daftar user (index) setelah berhasil membuat user baru,
        // dan menampilkan pesan sukses menggunakan with() agar dapat ditampilkan pada halaman tersebut.
        return redirect()->route('admin.kelola-user')->with('success', 'Berhasil membuat user');
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
