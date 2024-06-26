<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    protected $table = 'foto';
    protected $primaryKey = 'FotoID';
    protected $guarded = ['FotoID'];
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
    public function album()
    {
        return $this->belongsTo(Album::class, 'AlbumID');
    }
}
