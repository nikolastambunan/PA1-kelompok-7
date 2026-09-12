<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class QrDestination extends Model
{
    use HasFactory;

    protected $table = 'qr_destinations';

    protected $fillable = [
        'kode',
        'nama',
        'nama_en',
        'slug',
        'kategori',
        'deskripsi_singkat',
        'deskripsi_lengkap',
        'deskripsi_lengkap_en',
        'lokasi',
        'google_maps_url',
        'jam_operasional',
        'harga_tiket',
        'fasilitas',
        'gambar',
        'status',
        'views',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function getNamaTransAttribute(): string
    {
        if (app()->getLocale() === 'en' && !empty($this->nama_en)) {
            return $this->nama_en;
        }
        return $this->nama ?? '';
    }

    public function getDeskripsiTransAttribute(): string
    {
        if (app()->getLocale() === 'en' && !empty($this->deskripsi_lengkap_en)) {
            return $this->deskripsi_lengkap_en;
        }
        return $this->deskripsi_lengkap ?? '';
    }

    public function getGambarUrlAttribute(): string
    {
        if (!$this->gambar) {
            return asset('image/default.jpg');
        }
        if (filter_var($this->gambar, FILTER_VALIDATE_URL)) {
            return $this->gambar;
        }
        if (file_exists(public_path($this->gambar))) {
            return asset($this->gambar);
        }
        return asset('image/default.jpg');
    }

    public function getQrCodeUrlAttribute(): string
    {
        return route('qr.show', $this->kode);
    }
}
