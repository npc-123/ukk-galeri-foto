<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarFoto extends Model
{
    use HasFactory;
    protected $table = 'komentarfoto';
    protected $primaryKey = 'KomentarID';
    protected $guarded = ['KomentarID'];
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
}
