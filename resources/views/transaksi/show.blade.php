@extends('layouts/layouts-dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Show Transaksi</h2>
            <a class="btn btn-primary" href="{{ route('transaksi.index') }}"> Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nomor Rekening:</strong>
                {{ $transaksi->nomor_rekening }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jenis Transaksi:</strong>
                {{ $transaksi->jenis_transaksi }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Transaksi:</strong>
                {{ $transaksi->tanggal_transaksi }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jumlah Transaksi:</strong>
                {{ $transaksi->jumlah_transaksi }}
            </div>
        </div>
    </div>
</div>
@endsection
