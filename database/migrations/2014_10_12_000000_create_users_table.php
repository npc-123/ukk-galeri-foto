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
            // $table->id('UserID');
            $table->integer('UserID', 11)->autoIncrement();
            $table->string('username', 255)->unique();
            $table->string('password', 255);
            $table->string('email', 255)->unique();
            $table->string('NamaLengkap', 255);
            $table->string('Foto', 255)->default('image/default/profile.png');
            $table->text('Alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
