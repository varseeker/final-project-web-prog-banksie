<?php

namespace App\Http\Controllers;

use App\Models\expenseItems;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExpenseBoardsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExpenseItemsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::insert('insert into expense_items (id, boardOwner, itemName, itemDesc, itemPrice, created_at, updated_at, status) values (?, ?, ?, ?, ?, ?, ?, ?)', [NULL, $request->route('id'), '', '', NULL, NULL, NULL, 'unchecked']);
        return redirect()->route('board-index', ['id' => $request->route('id')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(expenseItems $expenseItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(expenseItems $expenseItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, expenseItems $expenseItems)
    {
        
        date_default_timezone_set('Asia/Jakarta');
        
        $items = DB::table('expense_items')
        ->where('boardOwner', $request->route('id'))
        ->select('id')
        ->get();

        
        // $a = [];
        // love u bro :*

        foreach($items as $i){
            foreach($i as $p){

                if($request->input("status_".$p)==''){
                    
                    $expenseItems = expenseItems::updateOrCreate(
                        ['id' => $request->input("row_".$p)],
                        [
                            'boardOwner' => $request->route('id'), 
                            'itemName' => $request->input("name_".$p), 
                            'itemDesc' => $request->input("desc_".$p), 
                            'itemPrice' => str_replace(['+', '-'], '', filter_var($request->input("price_".$p), FILTER_SANITIZE_NUMBER_INT)), 
                            
                            'updated_at' => now()
                        ]
                    );

                }else{
                    $expenseItems = expenseItems::updateOrCreate(
                        ['id' => $request->input("row_".$p)],
                        [
                            'status' => "checked", 
                        ]
                    );
                }
                // array_push($a, $request->input("status_".$p));
                // biggest honor for being a good debuging line
            }
        }


        // $j =  [$request->input("name_2"), $request->input("desc_2")];

        // return view(dd($j, $a, $expenseItems)
        return redirect()->route('board-index', ['id' => $request->route('id')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, expenseItems $expenseItems)
    {
        expenseItems::destroy($request->input("delete-target"));
        // return view(dd($request->input("delete-target")));
        return redirect()->route('board-index', ['id' => $request->route('id')]);
    }
}
