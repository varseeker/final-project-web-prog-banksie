@extends('layouts/layouts-dashboard')

@section('content')
    @if(Auth::user()->role === 'admin')
    <div class="row">
    <h1>Dashboard Admin Web Perbankan</h1>
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
                                <span>{{ $transaksi->jenis_transaksi }}</span> - Rp. {{ number_format($transaksi->jumlah_transaksi, 0, ',', '.') }}
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
    @endif
    @if(Auth::user()->role === 'nasabah')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($errors->has('message'))
        <div class="alert alert-danger">
            <p>{{ $errors->first('message') }}</p>
        </div>
    @endif
    <div class="container">
    <h1>Dashboard Web Perbankan</h1>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahRekeningModal">Tambah Rekening</button>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($produkNasabah as $produk)
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $produk->nama }}</h5>
                        <p class="card-text">No Rekening: {{ $produk->nomor_rekening }}</p>
                        <div class="saldo">Saldo: {{ $produk->saldo }}</div>
                        <div class="transfer-button mt-3">
                            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#transferModal" 
                                onclick="setTransferDetails('{{ $produk->nama }}', '{{ $produk->nomor_rekening }}')">
                                Transfer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transferModalLabel">Detail Transfer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('transfer.submitTransfer') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="produk" class="form-label">Produk</label>
                            <input type="text" id="produk" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nomor_rekening_asal" class="form-label">No Rekening Produk</label>
                            <input type="text" id="nomor_rekening_asal" name="nomor_rekening_asal" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="bankTujuan" class="form-label">Bank Tujuan</label>
                            <select name="bankTujuan" id="bankTujuan" class="form-select" required onchange="toggleRekeningValidation()">
                                <option value="">-- Pilih Bank --</option>
                                <option value="banksie">Banksie</option>
                                <option value="lainnya">Bank Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nomor_rekening" class="form-label">No Rekening</label>
                            <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nominal" class="form-label">Nominal</label>
                            <input type="number" name="nominal" id="nominal" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Rekening -->
    <div class="modal fade" id="tambahRekeningModal" tabindex="-1" aria-labelledby="tambahRekeningModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('rekening.addRekening') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahRekeningModalLabel">Tambah Rekening</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="id_produk" class="form-label">Pilih Produk</label>
                            <select name="id_produk" id="id_produk" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Produk --</option>
                                @foreach ($produkList as $produk)
                                    <option value="{{ $produk->id_produk }}">{{ $produk->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="saldo_awal" class="form-label">Saldo Awal</label>
                            <input type="number" name="saldo_awal" id="saldo_awal" class="form-control" required min="0">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function setTransferDetails(namaProduk, noRekening) {
            document.getElementById('produk').value = namaProduk;
            document.getElementById('nomor_rekening_asal').value = noRekening;
        }

        function toggleRekeningValidation() {
            const bankTujuan = document.getElementById('bankTujuan').value;
            const noRekening = document.getElementById('nomor_rekening');
            
            if (bankTujuan === 'banksie') {
                noRekening.addEventListener('blur', validateRekening);
            } else {
                noRekening.removeEventListener('blur', validateRekening);
            }
        }

        function validateRekening() {
            const noRekening = document.getElementById('nomor_rekening').value;

            if (noRekening.trim() === '') {
                return;
            }

            fetch(`/cek-rekening/${noRekening}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.message) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Rekening Tidak Ditemukan',
                            text: 'Nomor rekening yang Anda masukkan tidak terdaftar.',
                        }).then(() => {
                            document.getElementById('nomor_rekening').value = '';
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
    @endif
@endsection

@section('scripts')
    @if(Auth::user()->role === 'admin')
    @endif
@endsection