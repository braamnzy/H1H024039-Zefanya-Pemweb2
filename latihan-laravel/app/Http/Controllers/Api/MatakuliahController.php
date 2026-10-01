<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMatakuliahRequest;
use App\Http\Requests\UpdateMatakuliahRequest;
use App\Http\Resources\MatakuliahResource;
use App\Models\Matakuliah;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * GET /api/matakuliah
     * Query params: cari, semester, program_studi_id, urut, arah, per_halaman
     */
    public function index(Request $request)
    {
        $kueri = Matakuliah::query()->with('programStudi');

        // Filter pencarian (nama / kode)
        if ($request->filled('cari')) {
            $kataKunci = $request->query('cari');
            $kueri->where(function ($sub) use ($kataKunci) {
                $sub->where('nama', 'like', '%' . $kataKunci . '%')
                    ->orWhere('kode', 'like', '%' . $kataKunci . '%');
            });
        }

        // Filter semester
        if ($request->filled('semester')) {
            $kueri->where('semester', $request->integer('semester'));
        }

        // Filter program studi
        if ($request->filled('program_studi_id')) {
            $kueri->where('program_studi_id', $request->integer('program_studi_id'));
        }

        // Sorting dengan whitelist
        $urutan = $request->query('urut', 'nama');
        $arah = $request->query('arah', 'asc');
        $kolomDiizinkan = ['kode', 'nama', 'sks', 'semester'];

        if (in_array($urutan, $kolomDiizinkan, true)) {
            $kueri->orderBy($urutan, $arah === 'desc' ? 'desc' : 'asc');
        }

        // Pagination (maks 100)
        $perHalaman = min($request->integer('per_halaman', 10), 100);

        return MatakuliahResource::collection($kueri->paginate($perHalaman));
    }

    /**
     * POST /api/matakuliah
     */
    public function store(StoreMatakuliahRequest $request): JsonResponse
    {
        $matakuliah = Matakuliah::create($request->validated());
        $matakuliah->load('programStudi');

        return response()->json([
            'sukses' => true,
            'pesan'  => 'Data matakuliah berhasil dibuat',
            'data'   => new MatakuliahResource($matakuliah),
        ], 201);
    }

    /**
     * GET /api/matakuliah/{matakuliah}
     */
    public function show(Matakuliah $matakuliah): JsonResponse
    {
        $matakuliah->load('programStudi');

        return response()->json([
            'sukses' => true,
            'data'   => new MatakuliahResource($matakuliah),
        ]);
    }

    /**
     * PUT/PATCH /api/matakuliah/{matakuliah}
     */
    public function update(UpdateMatakuliahRequest $request, Matakuliah $matakuliah): JsonResponse
    {
        $matakuliah->update($request->validated());
        $matakuliah->load('programStudi');

        return response()->json([
            'sukses' => true,
            'pesan'  => 'Data matakuliah berhasil diperbarui',
            'data'   => new MatakuliahResource($matakuliah),
        ]);
    }

    /**
     * DELETE /api/matakuliah/{matakuliah}
     */
    public function destroy(Matakuliah $matakuliah): JsonResponse
    {
        $matakuliah->delete();

        return response()->json([
            'sukses' => true,
            'pesan'  => 'Data matakuliah berhasil dihapus',
        ]);
    }
}