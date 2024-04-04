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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->integer('UserID');
            $table->integer('dariUserID');
            $table->string('tipe');
            $table->string('isi');
            $table->integer('KomentarID')->nullable();
            $table->integer('FotoID');

            $table->foreign('UserID')
                ->references('UserID')->on('users')
                ->onDelete('cascade');
            $table->foreign('dariUserID')
                ->references('UserID')->on('users')
                ->onDelete('cascade');
            $table->foreign('KomentarID')
                ->references('KomentarID')->on('komentarfoto')
                ->onDelete('cascade');
            $table->foreign('FotoID')
                ->references('FotoID')->on('foto')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
