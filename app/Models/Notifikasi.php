<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $table = 'notifikasi';
    protected $guarded = ['id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'dariUserID');
    }
    public function foto()
    {
        return $this->belongsTo(Foto::class, 'FotoID');
    }
}
