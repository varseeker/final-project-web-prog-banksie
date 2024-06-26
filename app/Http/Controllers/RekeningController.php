<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rekenings = Rekening::all();
        return view('rekening.index', compact('rekenings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nasabahs = Nasabah::all();
        return view('rekening.create', compact('nasabahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        error_log($request);
        try {
            $data = $request->all();
            $data['saldo'] = str_replace(',', '', $data['saldo']); // Remove commas for validation
        
            $request->merge(['saldo' => $data['saldo']]);
        
            $request->validate([
                'id_nasabah' => 'required',
                'jenis_rekening' => 'required',
                'saldo' => 'required|numeric',
                'tanggal_pembukaan' => 'required|date',
            ]);
            
            Rekening::create($data);
            return redirect()->route('rekening.index')->with('success', 'Rekening created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => $e->getMessage()])->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Rekening $rekening)
    {
        return view('rekening.show', compact('rekening'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rekening $rekening)
    {
        $nasabahs = Nasabah::all();
        return view('rekening.edit', compact('rekening', 'nasabahs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rekening $rekening)
    {
        $request->validate([
            'id_nasabah' => 'required',
            'jenis_rekening' => 'required',
            'saldo' => 'required|numeric',
            'tanggal_pembukaan' => 'required|date',
        ]);

        $data = $request->all();
        $data['saldo'] = str_replace(',', '', $data['saldo']); // Remove commas for database storage

        $rekening->update($data);
        return redirect()->route('rekening.index')->with('success', 'Rekening updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rekening $rekening)
    {
        $rekening->delete();
        return redirect()->route('rekening.index')->with('success', 'Rekening deleted successfully.');
    }
}
