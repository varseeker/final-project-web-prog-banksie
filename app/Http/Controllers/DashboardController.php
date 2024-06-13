<?php

namespace App\Http\Controllers;

use App\Models\expenseBoards;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $totalSaldo = Account::sum('balance');
        // $rekeningAktif = Account::where('status', 'active')->count();
        // $transaksiTerbaru = Transaction::orderBy('created_at', 'desc')->limit(5)->get();
        // $nasabahBaru = Account::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $totalSaldo = 0;
        $rekeningAktif = 0;
        $transaksiTerbaru = [];
        $nasabahBaru = 0;
        // Data for charts (assuming you have logic to get this data)
        $transaksiBulananLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        $transaksiBulananData = [100, 150, 200, 180, 120, 160]; // Replace with actual data logic
        $saldoRekeningLabels = ['Tabungan', 'Giro', 'Deposito'];
        $saldoRekeningData = [50, 30, 20]; // Replace with actual data logic

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
