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
        Schema::create('komentarfoto', function (Blueprint $table) {
            $table->integer('KomentarID', 11)->autoIncrement();
            
            $table->integer('FotoID');
            $table->foreign('FotoID')
            ->references('FotoID')->on('foto')
            ->onDelete('cascade');

            $table->integer('UserID');
            $table->foreign('UserID')
            ->references('UserID')->on('users')
            ->onDelete('cascade');

            $table->text('IsiKomentar');
            $table->date('TanggalKomentar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentarfoto');
    }
};
