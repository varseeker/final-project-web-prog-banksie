@extends('layouts/layouts-dashboard')

@section('content')
<div class="container">
    <h1>Data Nasabah</h1>
    <a href="{{ route('nasabah.create') }}" class="btn btn-primary">Tambah Nasabah</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Email</th>
                <th>Tanggal Lahir</th>
                <th>Status Pekerjaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nasabah as $n)
            <tr>
                <td>{{ $n->id_nasabah }}</td>
                <td>{{ $n->nama }}</td>
                <td>{{ $n->alamat }}</td>
                <td>{{ $n->nomor_telepon }}</td>
                <td>{{ $n->email }}</td>
                <td>{{ $n->tanggal_lahir }}</td>
                <td>{{ $n->status_pekerjaan }}</td>
                <td>
                    <a href="{{ route('nasabah.show', $n->id_nasabah) }}" class="btn btn-info">Detail</a>
                    <a href="{{ route('nasabah.edit', $n->id_nasabah) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('nasabah.destroy', $n->id_nasabah) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
