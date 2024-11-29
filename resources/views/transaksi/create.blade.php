@extends('layouts/layouts-dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Tambah Transaksi</h2>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{-- <strong>Whoops!</strong> There were some problems with your input.<br><br> --}}
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="nomor_rekening">Rekening :</label>
                    <select name="nomor_rekening" class="form-control" required>
                        <option value="" disabled selected>Select Nasabah</option>
                        @foreach($rekenings as $rekening)
                            <option value="{{ (string)$rekening->nomor_rekening }}">{{ $rekening->nasabah->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jenis Transaksi:</strong>
                    <select name="jenis_transaksi" class="form-control">
                        <option value="Top Up">Top Up</option>
                        <option value="Payment">Payment</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Transaksi:</strong>
                    <input type="date" name="tanggal_transaksi" class="form-control" placeholder="Tanggal Transaksi" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah Transaksi:</strong>
                    <input type="text" id="jumlah_transaksi" name="jumlah_transaksi" class="form-control" placeholder="Jumlah Transaksi" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('jumlah_transaksi').addEventListener('input', function (e) {
        let value = e.target.value.replace(/,/g, '').replace(/[^\d.]/g, '');
        if (!isNaN(value) && value !== '') {
            let formattedValue = parseFloat(value).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            e.target.value = formattedValue;
        } else {
            e.target.value = '';
        }
    });
</script>
@endsection
