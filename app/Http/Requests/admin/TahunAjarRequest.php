<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class TahunAjarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id_tahun_ajar' => 'required', // Kolom 'id_tahun_ajar' harus diisi (tidak boleh kosong).
            'tahun' => [ // Kolom 'tahun' memiliki beberapa aturan validasi.
                'required', // Kolom 'tahun' harus diisi (tidak boleh kosong).
                'unique:tahun_ajars,tahun', // Kolom 'tahun' harus unik dalam tabel 'tahun_ajars'.
                function ($attribute, $value, $fail) {
                    // Closure (fungsi anonim) untuk validasi kustom.
                    // Memisahkan tahun menggunakan karakter '/'.
                    $tahunParts = explode('/', $value);

                    // Memastikan format tahun benar (terdiri dari dua bagian setelah pemisah '/').
                    if (count($tahunParts) !== 2) {
                        $fail('Format tahun tidak valid. Contoh format yang benar: 2020/2021');
                        return;
                    }

                    // Memeriksa apakah tahun pertama dan tahun kedua sama.
                    if ($tahunParts[0] === $tahunParts[1]) {
                        $fail('Tahun tidak boleh sama. Contoh yang tidak diizinkan: 2020/2020');
                        return;
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'tahun.required' => 'Masukkan tahun ajaran terlebih dahulu',
            'tahun.unique' => 'Tahun ajaran tidak boleh kembar dari data sebelumnya'
        ];
    }

}
