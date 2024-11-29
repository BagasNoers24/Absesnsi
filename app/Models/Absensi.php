<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';
    protected $fillable = [
        'nama', 
        'nik', 
        'jamabsen', 
        'latitude', 
        'longitude', 
        'photo_path',
    ];

    
}


