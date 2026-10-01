<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMatakuliahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $matakuliah = $this->route('matakuliah');
        $id = $matakuliah instanceof \App\Models\Matakuliah
            ? $matakuliah->id
            : $matakuliah;

        return [
            'kode'             => ['sometimes', 'string', 'max:10', 'unique:matakuliahs,kode,' . $id],
            'nama'             => ['sometimes', 'string', 'max:100'],
            'sks'              => ['sometimes', 'integer', 'min:1', 'max:6'],
            'semester'         => ['sometimes', 'integer', 'min:1', 'max:14'],
            'program_studi_id' => ['sometimes', 'integer', 'exists:program_studis,id'],
        ];
    }
}
