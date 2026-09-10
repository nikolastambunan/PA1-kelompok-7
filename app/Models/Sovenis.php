<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sovenis extends Model
{
    use HasFactory;

    protected $table = 'sovenis';

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'harga',
        'status',
        'urutan'
    ];
}
