@extends('layouts.app')

@section('title', $destination->nama_trans . ' (' . $destination->kode . ') - Geosite Danau Toba')

@section('content')

<style>
    /* =========================================================================
       MOBILE FIRST STYLING KHUSUS SCAN QR CODE
       Dirancang super cepat, responsif, elegan di smartphone
    ========================================================================= */
    :root {
        --primary: #003366;
        --primary-dark: #001f3f;
        --gold: #c6a43b;
        --gold-light: #f1d26b;
        --gold-dark: #967a28;
        --text-dark: #0f172a;
        --text-muted: #64748b;
        --bg-soft: #f8fafc;
        --card-radius: 20px;
    }

    body {
        background-color: #f1f5f9;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .qr-mobile-wrapper {
        max-width: 860px;
        margin: 0 auto;
        padding: 16px 14px 60px;
    }

    /* Floating Banner QR Identitas */
    .qr-badge-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: white;
        border-radius: 16px;
        padding: 12px 18px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        margin-bottom: 16px;
        border: 1px solid #e2e8f0;
    }

    .qr-code-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #003366 0%, #1a4a7a 100%);
        color: white;
        font-weight: 800;
        font-size: 0.85rem;
        padding: 6px 14px;
        border-radius: 30px;
        letter-spacing: 1px;
    }

    .qr-scan-indicator {
        font-size: 0.75rem;
        color: #10b981;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .qr-scan-indicator span.pulse-dot {
        width: 8px;
        height: 8px;
        background-color: #10b981;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 rgba(16, 185, 129, 0.4);
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.6); }
        70% { box-shadow: 0 0 0 8px rgba(16, 185, 129, 0); }
        100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    /* Hero Media Card */
    .qr-hero-card {
        background: white;
        border-radius: var(--card-radius);
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        margin-bottom: 20px;
        position: relative;
    }

    .qr-hero-image-wrap {
        position: relative;
        width: 100%;
        height: 290px;
        background-color: #001f3f;
    }

    .qr-hero-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .qr-hero-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 70%;
        background: linear-gradient(to top, rgba(0, 31, 63, 0.9) 0%, transparent 100%);
    }

    .qr-hero-meta {
        position: absolute;
        bottom: 16px;
        left: 18px;
        right: 18px;
        color: white;
    }

    .qr-category-tag {
        display: inline-block;
        background: var(--gold);
        color: var(--primary-dark);
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 4px 10px;
        border-radius: 20px;
        margin-bottom: 6px;
    }

    .qr-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1.25;
        margin: 0;
        text-shadow: 0 2px 8px rgba(0,0,0,0.5);
    }

    /* Fast Action Bar (Google Maps & Share) */
    .qr-action-grid {
        display: grid;
        grid-template-columns: 1.8fr 1.2fr;
        gap: 12px;
        margin-bottom: 20px;
    }

    .btn-action-maps {
        background: linear-gradient(135deg, #003366 0%, #1a4a7a 100%);
        color: white;
        text-decoration: none;
        padding: 14px 16px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-weight: 700;
        font-size: 0.9rem;
        box-shadow: 0 4px 15px rgba(0, 51, 102, 0.25);
        transition: transform 0.2s ease;
    }

    .btn-action-maps:hover {
        color: white;
        transform: translateY(-2px);
    }

    .btn-action-share {
        background: white;
        color: #0f172a;
        text-decoration: none;
        padding: 14px 16px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-weight: 600;
        font-size: 0.88rem;
        border: 1px solid #cbd5e1;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-action-share:hover {
        background: #f8fafc;
        color: #003366;
    }

    /* Key Information Boxes */
    .qr-info-pills {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-bottom: 20px;
    }

    .info-pill-item {
        background: white;
        border-radius: 14px;
        padding: 14px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .info-pill-item i {
        font-size: 1.25rem;
        color: var(--gold);
        background: rgba(198, 164, 59, 0.12);
        padding: 8px;
        border-radius: 10px;
    }

    .info-pill-text {
        font-size: 0.72rem;
        color: var(--text-muted);
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .info-pill-val {
        font-size: 0.88rem;
        color: var(--text-dark);
        font-weight: 700;
        margin-top: 2px;
        line-height: 1.3;
    }

    /* Content Card */
    .qr-detail-card {
        background: white;
        border-radius: var(--card-radius);
        padding: 24px 20px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.03);
        border: 1px solid #e2e8f0;
        margin-bottom: 20px;
    }

    .qr-detail-card h3 {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 14px;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 10px;
    }

    .qr-detail-card p {
        color: #334155;
        font-size: 0.95rem;
        line-height: 1.8;
        margin-bottom: 12px;
        text-align: justify;
    }

    .location-box {
        background: #f8fafc;
        border-left: 4px solid var(--gold);
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 0.88rem;
        color: #334155;
        margin: 16px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .facilities-chip-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 10px;
    }

    .facility-chip {
        background: #eef2ff;
        color: #3730a3;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 20px;
        border: 1px solid #c7d2fe;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* Other QR Sites Carousel / Grid */
    .other-qr-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .other-qr-card {
        background: white;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        text-decoration: none;
        color: inherit;
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
    }

    .other-qr-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    }

    .other-qr-img {
        width: 100%;
        height: 110px;
        object-fit: cover;
    }

    .other-qr-body {
        padding: 10px 12px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .other-qr-badge {
        font-size: 0.65rem;
        font-weight: 700;
        color: var(--primary);
        background: #e0f2fe;
        padding: 2px 6px;
        border-radius: 4px;
        width: fit-content;
        margin-bottom: 4px;
    }

    .other-qr-name {
        font-size: 0.82rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        line-height: 1.3;
    }

    /* Footer Scan Watermark */
    .qr-scan-footer {
        text-align: center;
        padding: 25px 10px 10px;
        color: #94a3b8;
        font-size: 0.78rem;
    }

    .qr-scan-footer img {
        height: 24px;
        opacity: 0.7;
        margin-bottom: 6px;
    }

    @media (max-width: 480px) {
        .qr-action-grid { grid-template-columns: 1fr; }
        .qr-info-pills { grid-template-columns: 1fr; }
        .qr-hero-image-wrap { height: 230px; }
        .qr-hero-title { font-size: 1.45rem; }
    }
</style>

<div class="qr-mobile-wrapper">

    {{-- BAR STATUS SCAN QR --}}
    <div class="qr-badge-header">
        <div class="qr-code-pill">
            <i class="fas fa-qrcode"></i> {{ $destination->kode }}
        </div>
        <div class="qr-scan-indicator">
            <span class="pulse-dot"></span> Terverifikasi Resmi Geosite
        </div>
    </div>

    {{-- HERO CARD FOTO & JUDUL --}}
    <div class="qr-hero-card">
        <div class="qr-hero-image-wrap">
            <img src="{{ $destination->gambar_url }}" alt="{{ $destination->nama_trans }}" class="qr-hero-image" onerror="this.onerror=null; this.src='{{ asset('image/default.jpg') }}'">
            <div class="qr-hero-overlay"></div>
            <div class="qr-hero-meta">
                <span class="qr-category-tag">{{ $destination->kategori }}</span>
                <h1 class="qr-hero-title">{{ $destination->nama_trans }}</h1>
            </div>
        </div>
    </div>

    {{-- TOMBOL CEPAT (NAVIGASI GOOGLE MAPS & BAGIKAN) --}}
    <div class="qr-action-grid">
        @php
            $mapsLink = $destination->google_maps_url ?: 'https://www.google.com/maps/search/?api=1&query=' . urlencode($destination->nama . ' Toba');
        @endphp
        <a href="{{ $mapsLink }}" target="_blank" class="btn-action-maps">
            <i class="fas fa-location-arrow"></i> Petunjuk Arah (Maps)
        </a>
        <button type="button" onclick="shareDestination()" class="btn-action-share">
            <i class="fas fa-share-alt"></i> Bagikan
        </button>
    </div>

    {{-- INFO KUNCI CEPAT (JAM & HARGA) --}}
    <div class="qr-info-pills">
        <div class="info-pill-item">
            <i class="fas fa-clock"></i>
            <div>
                <div class="info-pill-text">Jam Buka</div>
                <div class="info-pill-val">{{ $destination->jam_operasional ?: 'Buka Setiap Hari' }}</div>
            </div>
        </div>
        <div class="info-pill-item">
            <i class="fas fa-ticket-alt"></i>
            <div>
                <div class="info-pill-text">Tiket Masuk</div>
                <div class="info-pill-val">{{ $destination->harga_tiket ?: 'Gratis' }}</div>
            </div>
        </div>
    </div>

    {{-- KONTEN DESKRIPSI UTAMA --}}
    <div class="qr-detail-card">
        <h3><i class="fas fa-book-open" style="color:var(--gold);"></i> Informasi & Sejarah</h3>
        
        @if($destination->deskripsi_singkat)
            <p style="font-weight: 600; color: #1e293b;">
                {{ $destination->deskripsi_singkat }}
            </p>
        @endif

        <p>{!! nl2br(e($destination->deskripsi_trans)) !!}</p>

        @if($destination->lokasi)
        <div class="location-box">
            <i class="fas fa-map-marker-alt" style="color: #dc2626; font-size: 1.1rem;"></i>
            <div><strong>Lokasi:</strong> {{ $destination->lokasi }}</div>
        </div>
        @endif

        @if($destination->fasilitas)
        <div style="margin-top: 20px;">
            <div style="font-size:0.8rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Fasilitas Tersedia:</div>
            <div class="facilities-chip-wrap">
                @foreach(explode(',', $destination->fasilitas) as $fasil)
                    <span class="facility-chip">
                        <i class="fas fa-check-circle" style="color:#4f46e5;"></i> {{ trim($fasil) }}
                    </span>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    {{-- ==================== FASILITAS & SARANA SEKITAR ==================== --}}
    @if(isset($fasilitasList) && $fasilitasList->count() > 0)
    <div class="qr-detail-card" style="padding-bottom: 16px;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
            <h3 style="margin-bottom:0; border:none; padding:0;"><i class="fas fa-concierge-bell" style="color:var(--gold);"></i> Fasilitas Sekitar</h3>
            <a href="{{ url('/fasilitas') }}" style="color:var(--primary); font-size:0.75rem; font-weight:700; text-decoration:none;">Semua →</a>
        </div>
        <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:10px;">
            @foreach($fasilitasList as $fas)
            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; overflow:hidden;">
                <img src="{{ $fas->gambar_url }}" alt="{{ $fas->nama_trans }}" style="width:100%; height:90px; object-fit:cover;" onerror="this.onerror=null; this.src='{{ asset('image/default.jpg') }}'">
                <div style="padding:8px 10px;">
                    <div style="font-size:0.8rem; font-weight:700; color:var(--primary);">{{ $fas->nama_trans }}</div>
                    <div style="font-size:0.68rem; color:#64748b;"><i class="fas fa-map-marker-alt"></i> {{ Str::limit($fas->lokasi ?: 'Danau Toba', 20) }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ==================== SOVENIR & LAPAK UMKM ==================== --}}
    @if(isset($umkmList) && $umkmList->count() > 0)
    <div class="qr-detail-card" style="padding-bottom: 16px;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
            <h3 style="margin-bottom:0; border:none; padding:0;"><i class="fas fa-shopping-bag" style="color:var(--gold);"></i> Sovenir & UMKM</h3>
            <a href="{{ route('umkm.index') }}" style="color:var(--primary); font-size:0.75rem; font-weight:700; text-decoration:none;">Semua →</a>
        </div>
        <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:10px;">
            @foreach($umkmList as $u)
            @php
                $uImg = $u->foto_utama ? asset($u->foto_utama) : asset('image/default.jpg');
            @endphp
            <a href="{{ route('fasilitas.umkm.detail', $u->id) }}" style="text-decoration:none; color:inherit; background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; overflow:hidden; display:block;">
                <img src="{{ $uImg }}" alt="{{ $u->nama_usaha_trans }}" style="width:100%; height:90px; object-fit:cover;" onerror="this.onerror=null; this.src='{{ asset('image/default.jpg') }}'">
                <div style="padding:8px 10px;">
                    <div style="font-size:0.8rem; font-weight:700; color:var(--primary);">{{ $u->nama_usaha_trans }}</div>
                    <div style="font-size:0.68rem; color:#64748b;"><i class="fas fa-user"></i> {{ $u->pemilik ?: 'Warga Lokal' }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ==================== PENGINAPAN SEKITAR ==================== --}}
    @if(isset($penginapanList) && $penginapanList->count() > 0)
    <div class="qr-detail-card" style="padding-bottom: 16px;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
            <h3 style="margin-bottom:0; border:none; padding:0;"><i class="fas fa-hotel" style="color:var(--gold);"></i> Penginapan</h3>
            <a href="{{ route('penginapan.index') }}" style="color:var(--primary); font-size:0.75rem; font-weight:700; text-decoration:none;">Semua →</a>
        </div>
        <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:10px;">
            @foreach($penginapanList as $p)
            <a href="{{ route('penginapan.detail', $p->id) }}" style="text-decoration:none; color:inherit; background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; overflow:hidden; display:block;">
                <img src="{{ $p->gambar_url }}" alt="{{ $p->nama_trans }}" style="width:100%; height:90px; object-fit:cover;" onerror="this.onerror=null; this.src='{{ asset('image/default.jpg') }}'">
                <div style="padding:8px 10px;">
                    <div style="font-size:0.8rem; font-weight:700; color:var(--primary);">{{ $p->nama_trans }}</div>
                    <div style="font-size:0.72rem; font-weight:700; color:#059669;">{{ $p->harga ?: 'Hubungi Pengelola' }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- JELAJAHI DESTINASI QR LAINNYA --}}
    @if(isset($otherDestinations) && $otherDestinations->count() > 0)
    <div class="qr-detail-card" style="padding-bottom: 16px;">
        <h3><i class="fas fa-compass" style="color:var(--gold);"></i> Titik Geosite Lainnya</h3>
        <p style="font-size:0.85rem; color:#64748b; margin-bottom:14px;">Scan juga titik QR Code edukasi di sekitar Anda:</p>
        <div class="other-qr-grid">
            @foreach($otherDestinations as $other)
            <a href="{{ route('qr.show', $other->kode) }}" class="other-qr-card">
                <img src="{{ $other->gambar_url }}" alt="{{ $other->nama }}" class="other-qr-img" onerror="this.onerror=null; this.src='{{ asset('image/default.jpg') }}'">
                <div class="other-qr-body">
                    <div>
                        <span class="other-qr-badge">{{ $other->kode }}</span>
                        <h5 class="other-qr-name">{{ $other->nama }}</h5>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- FOOTER KHUSUS QR --}}
    <div class="qr-scan-footer">
        <p><strong>GeoToba Smart Geotourism</strong></p>
        <p>© {{ date('Y') }} Kawasan Geosite Kaldera Danau Toba. Dilindungi UNESCO Global Geopark.</p>
    </div>

</div>

<script>
    function shareDestination() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $destination->nama_trans }} ({{ $destination->kode }})',
                text: 'Saya sedang menjelajahi {{ $destination->nama_trans }} di Geosite Danau Toba!',
                url: window.location.href,
            }).catch((error) => console.log('Error sharing', error));
        } else {
            // Fallback copy link
            navigator.clipboard.writeText(window.location.href);
            alert('Tautan halaman ini telah disalin ke clipboard!');
        }
    }
</script>

@endsection