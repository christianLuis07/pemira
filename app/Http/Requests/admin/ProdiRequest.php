<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ProdiRequest extends FormRequest
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
            'id_prodi' => 'required',
            'nama_prodi' => 'required|unique:prodis,nama_prodi'
        ];
    }
    
    public function messages(): array
    {
        return [
            'id_prodi.required' => 'Masukkan ID Prodi',
            'nama_prodi.required' => 'Masukkan nama prodi terlebih dahulu',
            'nama_prodi.unique' => 'Nama prodi tidak boleh sama'
        ];
    }
}
