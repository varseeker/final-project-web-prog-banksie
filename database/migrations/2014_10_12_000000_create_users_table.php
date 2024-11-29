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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('id_nasabah')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->timestamps();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
        });

        
        DB::table('users')->insert(
            array(
            'name' => 'admin-service',
            'email' => 'admin@admin',
            'password' => $password = Hash::make('admin123'),
            'role' => 'admin',
            )
        );
        DB::table('users')->insert(
            array(
            'name' => 'user1',
            'email' => 'user1@user',
            'password' => $password = Hash::make('user1'),
            'role' => 'nasabah',
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
