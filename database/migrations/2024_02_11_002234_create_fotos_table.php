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
        Schema::create('foto', function (Blueprint $table) {
            $table->integer('FotoID', 11)->autoIncrement();
            $table->string('JudulFoto', 255);
            $table->text('DeskripsiFoto');
            $table->date('TanggalUnggah');
            $table->string('LokasiFile', 255);
            
            $table->integer('AlbumID');
            $table->foreign('AlbumID')
            ->references('AlbumID')->on('album')
            ->onDelete('cascade');

            $table->integer('UserID');
            $table->foreign('UserID')
            ->references('UserID')->on('users')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto');
    }
};
