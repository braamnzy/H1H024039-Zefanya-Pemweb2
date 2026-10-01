@extends('layouts.app')

@section('judul', 'Detail Mahasiswa')

@section('konten')
<div class="card mb-4">
    <div class="card-header">Detail Informasi Mahasiswa</div>
    <div class="card-body">
        <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
        <p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
        <p><strong>Program Studi:</strong> {{ $mahasiswa->programStudi->nama }}</p>
        <p><strong>Angkatan:</strong> {{ $mahasiswa->angkatan }}</p>
        <p><strong>IPK:</strong> {{ $mahasiswa->ipk }}</p>
    </div>
</div>

<h4>Daftar Mata Kuliah yang Diambil</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Semester</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($mahasiswa->matakuliahs as $mk)
            <tr>
                <td>{{ $mk->kode }}</td>
                <td>{{ $mk->nama }}</td>
                <td>{{ $mk->sks }}</td>
                <td>{{ $mk->semester }}</td>
                <td><strong>{{ $mk->pivot->nilai ?? '-' }}</strong></td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada mata kuliah yang diambil.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<a href="{{ route('mahasiswa.data') }}" class="btn btn-secondary">Kembali</a>
@endsection