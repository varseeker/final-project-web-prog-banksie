<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->string('nomor_rekening');
            $table->enum('jenis_transaksi', ['beli/topup', 'jual', 'transfer']);
            $table->decimal('jumlah_transaksi', 15, 2);
            $table->timestamps();

            $table->foreign('nomor_rekening')->references('nomor_rekening')->on('rekening')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
