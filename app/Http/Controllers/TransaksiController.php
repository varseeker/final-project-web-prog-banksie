<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use App\Models\Transaksi;
use Illuminate\Http\Request;

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
}
