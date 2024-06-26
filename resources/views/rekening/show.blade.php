@extends('layouts/layouts-dashboard')

@section('content')
<div class="container">
    <h2>Rekening Details</h2>
    <table class="table">
        <tr>
            <th>Nomor Rekening:</th>
            <td>{{ $rekening->nomor_rekening }}</td>
        </tr>
        <tr>
            <th>ID Nasabah:</th>
            <td>{{ $rekening->id_nasabah }}</td>
        </tr>
        <tr>
            <th>Jenis Rekening:</th>
            <td>{{ $rekening->jenis_rekening }}</td>
        </tr>
        <tr>
            <th>Saldo:</th>
            <td>{{ $rekening->saldo }}</td>
        </tr>
        <tr>
            <th>Tanggal Pembukaan:</th>
            <td>{{ $rekening->tanggal_pembukaan }}</td>
        </tr>
    </table>
    <a href="{{ route('rekening.index') }}" class="btn btn-primary">Back to List</a>
</div>
@endsection
