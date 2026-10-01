<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
    /**
     * Kolom yang diizinkan untuk dipilih oleh klien.
     */
    protected array $kolomDiizinkan = [
        'id', 'nim', 'nama', 'email', 'angkatan', 'ipk', 'aktif', 'program_studi', 'dibuat_pada',
    ];

    public function toArray(Request $request): array
    {
        // Susun seluruh data terlebih dahulu
        $data = [
            'id'             => $this->id,
            'nim'            => $this->nim,
            'nama'           => $this->nama,
            'email'          => $this->email,
            'angkatan'       => $this->angkatan,
            'ipk'            => (float) $this->ipk,
            'aktif'          => (bool) $this->aktif,
            'program_studi'  => $this->whenLoaded('programStudi', function () {
                return [
                    'id'   => $this->programStudi->id,
                    'kode' => $this->programStudi->kode,
                    'nama' => $this->programStudi->nama,
                ];
            }),
            'dibuat_pada'    => $this->created_at?->toIso8601String(),
        ];

        // Jika klien mengirim ?fields=nim,nama,ipk
        if ($request->filled('fields')) {
            $fields = array_map('trim', explode(',', $request->query('fields')));

            // Sanitasi: hanya izinkan kolom yang ada di whitelist
            $fields = array_intersect($fields, $this->kolomDiizinkan);

            if (! empty($fields)) {
                return array_intersect_key($data, array_flip($fields));
            }
        }

        return $data;
    }
}