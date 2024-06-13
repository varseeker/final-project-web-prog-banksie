<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expenseBoards extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'userOwner', 'boardName', 'boardCur', 'urgency', 'created_at', 'updated_at'
    ];
}
