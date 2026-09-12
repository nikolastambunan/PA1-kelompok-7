<?php

namespace App\Http\Controllers;

use App\Models\QrDestination;
use Illuminate\Http\Request;

class PublicQrDestinationController extends Controller
{
    /**
     * Tampilkan katalog geosite QR Code untuk publik.
     */
    public function index()
    {
        $destinations = QrDestination::where('status', true)->orderBy('kode', 'asc')->get();
        return view('pages.qr.index', compact('destinations'));
    }

    /**
     * Tampilkan halaman responsif mobile saat QR Code di-scan oleh kamera HP.
     */
    public function show(string $kode)
    {
        $destination = QrDestination::where('kode', strtoupper($kode))->first();

        if (!$destination) {
            // Coba cari berdasarkan slug jika bukan kode
            $destination = QrDestination::where('slug', $kode)->firstOrFail();
        }

        // Hitung statistik scan / views
        $destination->increment('views');

        // Rekomendasi titik QR destinasi lainnya
        $otherDestinations = QrDestination::where('status', true)
            ->where('id', '!=', $destination->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        // Data Fasilitas, UMKM/Sovenir, Penginapan pendukung
        $umkmList = \App\Models\Umkm::where('status', 'aktif')->latest()->limit(4)->get();
        
        // Ambil fasilitas khusus destinasi ini (atau fallback umum jika belum ada khusus)
        $fasilitasQuery = \App\Models\Fasilitas::where('status', true);
        $fasilitasSpecific = (clone $fasilitasQuery)->where('destination_code', $destination->kode)->latest()->limit(6)->get();
        if ($fasilitasSpecific->count() > 0) {
            $fasilitasList = $fasilitasSpecific;
        } else {
            $fasilitasList = $fasilitasQuery->where(function($q) use ($destination) {
                $q->where('destination_code', $destination->kode)
                  ->orWhereNull('destination_code')
                  ->orWhere('destination_code', '');
            })->latest()->limit(6)->get();
        }

        $penginapanList = \App\Models\Penginapan::where('status', 1)->latest()->limit(4)->get();

        return view('pages.qr.show', compact('destination', 'otherDestinations', 'umkmList', 'fasilitasList', 'penginapanList'));
    }
}