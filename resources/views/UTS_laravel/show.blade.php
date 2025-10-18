@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Mahasiswa</h1>

    <table class="table">
        <tr><th>ID</th><td>{{ $m->id }}</td></tr>
        <tr><th>NIM</th><td>{{ $m->nim }}</td></tr>
        <tr><th>Nama</th><td>{{ $m->nama }}</td></tr>
        <tr><th>Alamat</th><td>{{ $m->alamat }}</td></tr>
        <tr><th>Kelas</th><td>{{ optional($m->kelas)->nama_kelas }}</td></tr>
        <tr><th>Dibuat</th><td>{{ $m->created_at }}</td></tr>
        <tr><th>Diperbarui</th><td>{{ $m->updated_at }}</td></tr>
    </table>

    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
