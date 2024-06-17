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
        Schema::create('nasabah', function (Blueprint $table) {
            $table->id('id_nasabah');
            $table->string('nama');
            $table->text('alamat');
            $table->string('nomor_telepon');
            $table->string('email');
            $table->date('tanggal_lahir');
            $table->string('status_pekerjaan');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabah');
    }
};
