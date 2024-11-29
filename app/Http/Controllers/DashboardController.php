<?php

namespace App\Http\Controllers;

use App\Models\expenseBoards;
use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login

        if ($user->role === 'admin') {
            // Logika untuk admin
            $totalSaldo = Rekening::sum('saldo');
            $rekeningAktif = Rekening::count();
            $transaksiTerbaru = Transaksi::orderBy('created_at', 'desc')->limit(5)->get();
            $nasabahBaru = Rekening::where('created_at', '>=', Carbon::now()->subDays(7))->count();

            $transaksiBulananLabels = ['Januari', 'Februari', 'Maret', 'April']; // Contoh data
            $transaksiBulananData = [10, 20, 30, 40]; // Contoh data
            $saldoRekeningLabels = ['Tabungan', 'Giro', 'Deposito'];
            $saldoRekeningData = [50000, 30000, 20000];

            return view('home', compact(
                'totalSaldo',
                'rekeningAktif',
                'transaksiTerbaru',
                'nasabahBaru',
                'transaksiBulananLabels',
                'transaksiBulananData',
                'saldoRekeningLabels',
                'saldoRekeningData'
            ));
        } elseif ($user->role === 'nasabah') {
            // Logika untuk nasabah
            // Ambil data produk yang dimiliki oleh nasabah berdasarkan `id_nasabah`
            $produkNasabah = DB::table('rekening')
            ->join('produk', 'rekening.id_produk', '=', 'produk.id_produk')
            ->where('rekening.id_nasabah', $user->id_nasabah)
            ->select('rekening.nomor_rekening', 'rekening.saldo', 'produk.nama')
            ->get();
            
            // Ambil daftar produk untuk dropdown Tambah Rekening
            $produkList = DB::table('produk')->get();

            return view('home', compact('produkNasabah', 'produkList'));
        }

        // Jika role tidak dikenali, kembalikan ke halaman error atau redirect
        return redirect()->route('home')->withErrors(['message' => 'Role tidak dikenali.']);
    }
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     $boards = DB::table('expense_boards')
    //         ->where('id', $request->route('id'))
    //         ->select('id', 'boardName', 'urgency','boardCur')
    //         ->get();
    //     $items = DB::table('expense_items')
    //         ->where('boardOwner', $request->route('id'))
    //         ->select('id', 'itemName', 'itemDesc','itemPrice','status')
    //         ->get();

    //     return view('boards/board', ['boards' => $boards, 'items' => $items]);
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
        
    //     date_default_timezone_set('Asia/Jakarta');
        
    //     if($request->input("board-name") == ' '){
    //         $boardNameVar = ' ';
    //     }else{
    //         $boardNameVar = $request->input("board-name");
    //     }
        


    //     DB::insert('insert into expense_boards (id, userOwner, boardName, boardCur, urgency, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?)', [NULL, Auth::user()->id, $boardNameVar, 'IDR', 'normal', now(), now()]);
    //     return redirect()->route('home');
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(expenseBoards $expenseBoards)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(expenseBoards $expenseBoards)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, expenseBoards $expenseBoards)
    // {
    //     expenseBoards::where($request->route('id'))
    //                 ->update([
    //                     'boardName' => $request->board_name
    //                 ]);
    //                 return redirect()->route('home');
                  
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Request $request, expenseBoards $expenseBoards)
    // {
    //     expenseBoards::destroy($request->input("board-target"));
    //     // return view(dd($request->input("board-target")));
    //     return redirect()->route('home');
    
    // }
}
