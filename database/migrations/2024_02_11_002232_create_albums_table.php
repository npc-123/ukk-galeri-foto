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
        Schema::create('album', function (Blueprint $table) {
            $table->integer('AlbumID', 11)->autoIncrement();
            $table->string('slug', 255);
            $table->string('NamaAlbum', 255);
            $table->text('Deskripsi');
            $table->date('TanggalDibuat');
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
        Schema::dropIfExists('album');
    }
};
