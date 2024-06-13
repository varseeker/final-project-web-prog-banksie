<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expense_boards', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('userOwner');
            $table->foreignId('userOwner')
                    ->references('id')
                    ->on('users');
            $table->char('boardName', 80)->nullable();
            $table->char('boardCur', 80)->nullable();
            $table->char('urgency', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expense_boards', function($table)
        {
            $table->dropForeign('userOwner');
            $table->foreign('userOwner')->references('id')->on('users');
        });
        Schema::dropIfExists('expense_boards');
        
    }
};
