<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::with('rekening.nasabah')->paginate(10);
        return view('transaksi.index', compact('transaksis'))
        ->with('i', (request()->input('page', 1) - 1) * 10);;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rekenings = Rekening::with('nasabah')->get();
        return view('transaksi.create', compact('rekenings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['jumlah_transaksi'] = str_replace(',', '', $data['jumlah_transaksi']); // Remove commas for validation
    
        $request->merge(['jumlah_transaksi' => $data['jumlah_transaksi']]);
        $request->validate([
            'nomor_rekening' => 'required|exists:rekening,nomor_rekening',
            'jenis_transaksi' => 'required',
            'tanggal_transaksi' => 'required',
            'jumlah_transaksi' => 'required|numeric',
        ]);

        $rekening = Rekening::where('nomor_rekening', $request->nomor_rekening)->first();

        if ($request->jenis_transaksi == 'Payment' && $rekening->saldo < $request->jumlah_transaksi) {
            return redirect()->route('transaksi.create')
                ->with('error', 'Saldo tidak mencukupi untuk melakukan pembayaran.');
        }

        if ($request->jenis_transaksi == 'Top Up') {
            $rekening->saldo += $request->jumlah_transaksi;
        } else if ($request->jenis_transaksi == 'Payment') {
            $rekening->saldo -= $request->jumlah_transaksi;
        }

        $rekening->save();

        Transaksi::create($request->all());

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'nomor_rekening' => 'required',
            'jenis_transaksi' => 'required',
            'tanggal_transaksi' => 'required',
            'jumlah_transaksi' => 'required|numeric',
        ]);

        $transaksi->update($request->all());

        return redirect()->route('transaksi.index')
                        ->with('success', 'Transaksi updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')
                        ->with('success', 'Transaksi deleted successfully');
    }

    public function submitTransfer(Request $request)
    {
        $request->validate([
            'nomor_rekening_asal' => 'required|exists:rekening,nomor_rekening',
            'bankTujuan' => 'required',
            'nomor_rekening' => 'required',
            'nominal' => 'required|numeric|min:0.01',
        ]);
    
        $rekeningAsal = Rekening::where('nomor_rekening', $request->nomor_rekening_asal)->first();

        // Cek saldo pengirim
        if (bccomp($rekeningAsal->saldo, $request->nominal, 2) === -1) {
            return back()->withErrors(['message' => 'Saldo tidak mencukupi untuk melakukan transfer.']);
        }
    
        if ($request->bankTujuan === 'banksie') {
            // Validasi nomor rekening tujuan
            $rekeningTujuan = Rekening::where('nomor_rekening', $request->nomor_rekening)->first();
        
            // Pastikan rekening asal dan tujuan tidak sama
            if ($rekeningAsal->nomor_rekening === $rekeningTujuan->nomor_rekening) {
                return back()->withErrors(['message' => 'Rekening asal dan tujuan tidak boleh sama.']);
            }
    
            if (!$rekeningTujuan) {
                return back()->withErrors(['message' => 'Nomor rekening tujuan tidak ditemukan.']);
            }
    
            // Lakukan transfer
            DB::transaction(function () use ($rekeningAsal, $rekeningTujuan, $request) {
                // Kurangi saldo pengirim dengan presisi
                $rekeningAsal->saldo = bcsub($rekeningAsal->saldo, $request->nominal, 2);
                $rekeningAsal->save();

                // Tambah saldo penerima dengan presisi
                $rekeningTujuan->saldo = bcadd($rekeningTujuan->saldo, $request->nominal, 2);
                $rekeningTujuan->save();
    
                // Simpan data transaksi
                Transaksi::create([
                    'jenis_transaksi' => 'Transfer',
                    'nomor_rekening' => $rekeningAsal->nomor_rekening,
                    'jumlah_transaksi' => $request->nominal,
                ]);
            });
        } else {
            // Bank lain: hanya menyimpan transaksi tanpa mengurangi/memvalidasi rekening tujuan
            Transaksi::create([
                'jenis_transaksi' => 'Transfer',
                'nomor_rekening' => $rekeningAsal->nomor_rekening,
                'jumlah_transaksi' => $request->nominal,
            ]);
            
            // Kurangi saldo pengirim dengan presisi
            $rekeningAsal->saldo = bcsub($rekeningAsal->saldo, $request->nominal, 2);
            $rekeningAsal->save();
        }
    
        return redirect()->back()->with('success', 'Transfer berhasil dilakukan.');

    }
}
