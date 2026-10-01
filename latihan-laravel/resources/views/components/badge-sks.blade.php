@props(['sks'])

@php
    // SKS di bawah 3 warna kuning/warning, 3 ke atas warna hijau/success
    $badgeClass = $sks < 3 ? 'bg-warning text-dark' : 'bg-success';
@endphp

<span {{ $attributes->merge(['class' => 'badge ' . $badgeClass]) }}>
    {{ $sks }} SKS
</span>