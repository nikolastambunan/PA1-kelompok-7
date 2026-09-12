@extends('layouts.admin')

@section('title', 'Edit Titik QR Destinasi ' . $destination->kode)

@section('content')

<style>
    .card { background: white; border-radius: 20px; box-shadow: 0 8px 30px rgba(0,0,0,0.08); overflow: hidden; }
    .card-header { padding: 18px 24px; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-bottom: 1px solid #e2e8f0; }
    .card-header h5 { margin: 0; font-size: 1.1rem; font-weight: 700; color: #003366; display: flex; align-items: center; gap: 8px; }
    .card-body { padding: 24px; }
    .form-group { margin-bottom: 20px; }
    label { display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.85rem; color: #1e293b; }
    .form-control { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: 0.85rem; }
    .form-control:focus { outline: none; border-color: #003366; box-shadow: 0 0 0 3px rgba(0,51,102,0.1); }
    .row-2col { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .btn-group { display: flex; gap: 12px; margin-top: 24px; }
    .btn-save { background: linear-gradient(135deg, #003366 0%, #1a4a7a 100%); color: white; padding: 10px 24px; border-radius: 10px; font-weight: 600; font-size: 0.85rem; border: none; cursor: pointer; }
    .btn-cancel { background: #f1f5f9; color: #475569; padding: 10px 24px; border-radius: 10px; font-weight: 600; font-size: 0.85rem; text-decoration: none; display: inline-block; }
    @media (max-width: 768px) { .row-2col { grid-template-columns: 1fr; } }
</style>

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-edit" style="color:#c6a43b;"></i> Edit Titik Destinasi QR: {{ $destination->kode }}</h5>
    </div>
    <div class="card-body">
        @if($errors->any())
        <div style="background:#fee2e2; color:#b91c1c; padding:12px 16px; border-radius:10px; margin-bottom:20px;">
            <ul style="margin:0; padding-left:20px;">
                @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.qr-destinasi.update', $destination->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row-2col">
                <div class="form-group">
                    <label>Kode Unik QR <span style="color:red;">*</span></label>
                    <input type="text" name="kode" class="form-control" value="{{ old('kode', $destination->kode) }}" required>
                </div>
                <div class="form-group">
                    <label>Nama Destinasi <span style="color:red;">*</span></label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $destination->nama) }}" required>
                </div>
            </div>

            <div class="row-2col">
                <div class="form-group">
                    <label>Kategori Destinasi <span style="color:red;">*</span></label>
                    <select name="kategori" class="form-control" required>
                        @foreach(['Geosite & Warisan Geologi', 'Wisata Alam & Danau', 'Wisata Budaya & Sejarah', 'Wisata Edukasi & Teknologi', 'Desa Wisata & Budaya', 'Wisata Alam & Camping'] as $kat)
                            <option value="{{ $kat }}" {{ old('kategori', $destination->kategori) == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Lokasi / Alamat</label>
                    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $destination->lokasi) }}">
                </div>
            </div>

            <div class="form-group">
                <label>Deskripsi Singkat (Preview Banner)</label>
                <textarea name="deskripsi_singkat" class="form-control" rows="2">{{ old('deskripsi_singkat', $destination->deskripsi_singkat) }}</textarea>
            </div>

            <div class="form-group">
                <label>Deskripsi Lengkap / Sejarah (Konten Edukasi Wisatawan) <span style="color:red;">*</span></label>
                <textarea name="deskripsi_lengkap" class="form-control" rows="6" required>{{ old('deskripsi_lengkap', $destination->deskripsi_lengkap) }}</textarea>
            </div>

            <div class="row-2col">
                <div class="form-group">
                    <label>Jam Operasional</label>
                    <input type="text" name="jam_operasional" class="form-control" value="{{ old('jam_operasional', $destination->jam_operasional) }}">
                </div>
                <div class="form-group">
                    <label>Harga Tiket</label>
                    <input type="text" name="harga_tiket" class="form-control" value="{{ old('harga_tiket', $destination->harga_tiket) }}">
                </div>
            </div>

            <div class="form-group">
                <label>URL Google Maps (Navigasi Pengunjung)</label>
                <input type="url" name="google_maps_url" class="form-control" value="{{ old('google_maps_url', $destination->google_maps_url) }}">
            </div>

            <div class="form-group">
                <label>Fasilitas (Pisahkan dengan koma)</label>
                <input type="text" name="fasilitas" class="form-control" value="{{ old('fasilitas', $destination->fasilitas) }}">
            </div>

            <div class="form-group">
                <label>Foto Destinasi</label>
                @if($destination->gambar)
                <div style="margin-bottom: 10px;">
                    <img src="{{ $destination->gambar_url }}" alt="Preview" style="height: 100px; border-radius: 8px; object-fit: cover;">
                </div>
                @endif
                <input type="file" name="gambar" class="form-control" accept="image/*">
            </div>

            <div style="display:flex; align-items:center; gap:10px; margin:20px 0;">
                <input type="checkbox" name="status" value="1" id="status" {{ old('status', $destination->status) ? 'checked' : '' }} style="width:18px; height:18px;">
                <label for="status" style="margin:0; cursor:pointer;">Status Aktif</label>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn-save">Perbarui Destinasi QR</button>
                <a href="{{ route('admin.qr-destinasi.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection