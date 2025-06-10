<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // Menentukan aturan validasi untuk setiap input yang ada dalam request.
        // Misalnya, untuk input 'username', maksimal panjangnya adalah 255 karakter,
        // harus diisi, harus berupa angka (numeric), dan harus unik di dalam tabel 'users'
        // pada kolom 'username'.
        // Untuk input 'email', harus diisi dan harus berupa alamat email yang valid.
        // Untuk input 'password', harus diisi.
        return [
            'username' => 'required|numeric|unique:users,username',
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    /**
     * Get custom validation messages for the defined rules.
     *
     * @return array
     */
    public function messages(): array
    {
        // Memberikan pesan kustom untuk setiap aturan validasi yang telah ditentukan
        // di metode 'rules()'. Pesan kustom ini akan ditampilkan ketika validasi gagal.
        // Misalnya, jika validasi 'username.max' gagal, maka pesan 'Panjang username
        // tidak boleh lebih dari :max karakter.' akan ditampilkan.
        return [
            'username.required' => 'Masukkan username / nim terlebih dahulu.',
            'username.numeric' => 'Username harus berupa angka.',
            'username.unique' => 'Username sudah digunakan, silakan gunakan username lain.',

            'email.required' => 'Masukkan alamat email terlebih dahulu.',
            'email.email' => 'Masukkan alamat email yang valid.',

            'password.required' => 'Masukkan password terlebih dahulu.',
            // Tambahkan pesan kustom lain di sini sesuai kebutuhan
        ];
    }
}
