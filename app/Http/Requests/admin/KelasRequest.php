<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class KelasRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'id_kelas' => 'unique:kelas,id_kelas',
            'nama_kelas' => 'required|unique:kelas,nama_kelas'
        ];
    }

    public function messages(): array
    {
        return [
            'id_kelas.unique' => 'Kode kelas sudah ada dalam database.',
            'nama_kelas.required' => 'Kelas harus diisi.',
            'nama_kelas.unique' => 'Kelas sudah ada dalam database.',
        ];
    }
}
