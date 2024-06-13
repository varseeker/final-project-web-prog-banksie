<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expenseItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'itemName', 'itemDesc', 'itemPrice', 'updated_at', 'status', 'boardOwner'
    ];

    
    // protected $attributes = [
    //     'itemName' =>  'add a name ',
    //     'itemDesc' => 'description about the item',
    //     'itemPrice' => '0',
    //     'status' => 'unchecked'
    // ];
}
