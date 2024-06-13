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
        Schema::create('expense_items', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('boardOwner');
            $table->foreignId('boardOwner')
                    ->references('id')
                    ->on('expense_boards')
                    ->onDelete('cascade');
            $table->char('itemName', 80)->nullable();
            $table->string('itemDesc', 800)->nullable();
            $table->integer('itemPrice')->nullable();
            $table->char('status', 9);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expense_items', function($table)
        {
            $table->dropForeign('boardOwner');
            $table->foreign('boardOwner')->references('id')->on('expenseBoards');
        });
        Schema::dropIfExists('expense_items');
    }
};
