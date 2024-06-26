<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;
    protected $table = 'rekening'; // Sesuaikan dengan nama tabel yang benar
    protected $primaryKey = 'nomor_rekening'; // Jika nama primary key berbeda, sesuaikan di sini
    // Sisanya sesuaikan dengan kolom-kolom yang ada dalam tabel
    public $incrementing = true;
    protected $fillable = [
        'id_nasabah',
        'jenis_rekening',
        'saldo',
        'tanggal_pembukaan',
    ];
    
}
