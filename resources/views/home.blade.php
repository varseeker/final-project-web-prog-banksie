@extends('layouts/layouts-dashboard')

@section('content')
    <h1>Dashboard Admin Web Perbankan</h1>

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Total Saldo</div>
                <div class="card-body">
                    <p>Rp. {{ number_format($totalSaldo, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Rekening Aktif</div>
                <div class="card-body">
                    <p>{{ $rekeningAktif }} Rekening</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Transaksi Terbaru</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach ($transaksiTerbaru as $transaksi)
                            <li class="list-group-item">
                                <span>{{ $transaksi->jenisTransaksi }}</span> - Rp. {{ number_format($transaksi->jumlah, 0, ',', '.') }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">Nasabah Baru</div>
                <div class="card-body">
                    <p>{{ $nasabahBaru }} Nasabah</p>
                    {{-- <a href="{{ route('admin.nasabah') }}" class="btn btn-primary">Lihat Nasabah</a> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <h3>Statistik Transaksi Bulanan</h3>
            <canvas id="transaksiBulananChart" width="400" height="200"></canvas>
        </div>
        <div class="col-md-6">
            <h3>Statistik Saldo Per Jenis Rekening</h3>
            <canvas id="saldoRekeningChart" width="400" height="200"></canvas>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.0-release/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.0-release/chart.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Grafik Transaksi Bulanan
            const ctxTransaksiBulanan = document.getElementById('transaksiBulananChart').getContext('2d');
            new Chart(ctxTransaksiBulanan, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($transaksiBulananLabels) !!},
                    datasets: [{
                        label: 'Jumlah Transaksi',
                        data: {!! json_encode($transaksiBulananData) !!},
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgb(75, 192, 192)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Grafik Saldo Per Jenis Rekening
            const ctxSaldoRekening = document.getElementById('saldoRekeningChart').getContext('2d');
            new Chart(ctxSaldoRekening, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($saldoRekeningLabels) !!},
                    datasets: [{
                        data: {!! json_encode($saldoRekeningData) !!},
                        backgroundColor: ['#f44336', '#e91e63', '#9c27b0', '#673ab7', '#3f51b5'],
                        hoverBackgroundColor: ['#f44336', '#e91e63', '#9c27b0', '#673ab7', '#3f51b5']
                    }]
                }
            });
        });
    </script>
@endsection