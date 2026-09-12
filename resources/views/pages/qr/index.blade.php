@extends('layouts.app')

@section('title', 'Panduan QR Code Geosite - GeoToba')

@section('content')

<style>
    :root {
        --primary: #003366;
        --gold: #c6a43b;
        --card-radius: 16px;
    }

    .qr-directory-hero {
        background: linear-gradient(135deg, #001f3f 0%, #003366 100%);
        padding: 100px 20px 50px;
        color: white;
        text-align: center;
    }

    .qr-directory-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2.4rem;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .qr-directory-hero h1 span {
        color: var(--gold);
    }

    .qr-directory-hero p {
        color: rgba(255, 255, 255, 0.85);
        max-width: 650px;
        margin: 0 auto;
        font-size: 0.95rem;
    }

    .qr-grid-container {
        max-width: 1200px;
        margin: -30px auto 60px;
        padding: 0 20px;
    }

    .qr-card-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
    }

    .qr-item-card {
        background: white;
        border-radius: var(--card-radius);
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        border: 1px solid #e2e8f0;
    }

    .qr-item-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    }

    .qr-item-thumb {
        position: relative;
        height: 190px;
        overflow: hidden;
    }

    .qr-item-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .qr-item-code {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #003366;
        color: white;
        font-weight: 800;
        font-size: 0.75rem;
        padding: 5px 12px;
        border-radius: 20px;
        letter-spacing: 1px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    }

    .qr-item-content {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .qr-item-cat {
        font-size: 0.72rem;
        font-weight: 700;
        color: var(--gold);
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .qr-item-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: #003366;
        margin-bottom: 8px;
    }

    .qr-item-desc {
        color: #64748b;
        font-size: 0.85rem;
        line-height: 1.6;
        margin-bottom: 16px;
    }

    .qr-item-btn {
        background: linear-gradient(135deg, #003366 0%, #1a4a7a 100%);
        color: white;
        text-decoration: none;
        padding: 10px 16px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: background 0.2s;
    }

    .qr-item-btn:hover {
        background: #1a4a7a;
        color: white;
    }
</style>

<div class="qr-directory-hero">
    <h1>Titik Wisata <span>QR Code Geosite</span></h1>
    <p>Akses informasi lengkap dan panduan digital saat Anda mengunjungi 7 titik geosite terverifikasi di kawasan Balige & Meat Danau Toba.</p>
</div>

<div class="qr-grid-container">
    <div class="qr-card-list">
        @foreach($destinations as $dest)
        <div class="qr-item-card">
            <div class="qr-item-thumb">
                <img src="{{ $dest->gambar_url }}" alt="{{ $dest->nama }}" onerror="this.onerror=null; this.src='{{ asset('image/default.jpg') }}'">
                <span class="qr-item-code"><i class="fas fa-qrcode"></i> {{ $dest->kode }}</span>
            </div>
            <div class="qr-item-content">
                <div>
                    <div class="qr-item-cat">{{ $dest->kategori }}</div>
                    <h3 class="qr-item-title">{{ $dest->nama }}</h3>
                    <p class="qr-item-desc">{{ Str::limit($dest->deskripsi_singkat ?: strip_tags($dest->deskripsi_lengkap), 110) }}</p>
                </div>
                <a href="{{ route('qr.show', $dest->kode) }}" class="qr-item-btn">
                    <i class="fas fa-arrow-right"></i> Buka Halaman QR
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection