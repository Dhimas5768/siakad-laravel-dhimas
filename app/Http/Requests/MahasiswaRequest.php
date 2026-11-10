<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('mahasiswa') ? $this->route('mahasiswa')->id : null;
        
        return [
            'nim' => 'required|string|max:20|unique:mahasiswa,nim,' . $id,
            'nama' => 'required|string|max:120',
            'email' => 'required|email|max:120|unique:mahasiswa,email,' . $id,
            'telepon' => 'nullable|string|max:20',
            'angkatan' => 'required|string|max:10',
            'alamat' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah dipakai oleh mahasiswa lain.',
            'nama.required' => 'Nama mahasiswa wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah dipakai oleh mahasiswa lain.',
            'angkatan.required' => 'Tahun angkatan wajib diisi.',
        ];
    }
}