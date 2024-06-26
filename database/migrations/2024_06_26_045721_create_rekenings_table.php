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
        Schema::create('rekening', function (Blueprint $table) {
            $table->id('nomor_rekening'); // Primary key with positive values
            $table->foreignId('id_nasabah')->constrained('nasabah', 'id_nasabah')->onDelete('cascade'); // Foreign key referencing 'nasabah.id'
            $table->string('jenis_rekening');
            $table->decimal('saldo', 15, 2);
            $table->date('tanggal_pembukaan');
            $table->timestamps(); // Use Laravel's helper for timestamps
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekening');
    }
};
