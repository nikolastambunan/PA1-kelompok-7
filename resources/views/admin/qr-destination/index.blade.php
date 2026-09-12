@extends('layouts.admin')

@section('title', 'Manajemen QR Code Destinasi')

@section('content')

<style>
    .card-table { background: white; border-radius: 20px; box-shadow: 0 8px 30px rgba(0,0,0,0.08); overflow: hidden; }
    .card-header { display: flex; justify-content: space-between; align-items: center; padding: 18px 24px; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-bottom: 1px solid #e2e8f0; flex-wrap: wrap; gap: 12px; }
    .card-header h5 { margin: 0; font-size: 1.1rem; font-weight: 700; color: #003366; display: flex; align-items: center; gap: 8px; }
    .card-header h5 i { color: #c6a43b; }
    .btn-primary { background: linear-gradient(135deg, #003366 0%, #1a4a7a 100%); color: white; padding: 8px 18px; border-radius: 12px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-size: 0.85rem; font-weight: 600; border: none; cursor: pointer; }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,51,102,0.3); color: white; }
    
    .table-wrapper { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; min-width: 750px; }
    thead { background: #f8fafc; }
    th { padding: 14px 16px; text-align: left; font-weight: 700; font-size: 0.8rem; color: #003366; border-bottom: 2px solid #e2e8f0; }
    td { padding: 14px 16px; border-bottom: 1px solid #eef2f6; vertical-align: middle; font-size: 0.85rem; color: #1e293b; }
    
    .qr-badge {
        background: #003366;
        color: white;
        font-weight: 800;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 6px;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .qr-thumb-box {
        width: 55px;
        height: 55px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 3px;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .qr-thumb-box canvas, .qr-thumb-box img {
        width: 100% !important;
        height: 100% !important;
    }

    .btn-action-group {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .btn-action-btn {
        padding: 5px 10px;
        border-radius: 8px;
        font-size: 0.725rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        border: 1px solid transparent;
        cursor: pointer;
    }

    .btn-action-view { background: #e0f2fe; color: #0284c7; border-color: #bae6fd; }
    .btn-action-print { background: #fef3c7; color: #b45309; border-color: #fde68a; }
    .btn-action-edit { background: #f1f5f9; color: #334155; border-color: #cbd5e1; }
    .btn-action-delete { background: #fee2e2; color: #dc2626; border-color: #fecaca; }

    .switch-toggle {
        position: relative;
        display: inline-block;
        width: 44px;
        height: 22px;
    }
    .switch-toggle input { opacity: 0; width: 0; height: 0; }
    .slider-toggle {
        position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0;
        background-color: #cbd5e1; transition: .3s; border-radius: 22px;
    }
    .slider-toggle:before {
        position: absolute; content: ""; height: 16px; width: 16px; left: 3px; bottom: 3px;
        background-color: white; transition: .3s; border-radius: 50%;
    }
    input:checked + .slider-toggle { background-color: #10b981; }
    input:checked + .slider-toggle:before { transform: translateX(22px); }

    /* Modal QR Preview */
    .qr-modal {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.6);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }
    .qr-modal.active { display: flex; }
    .qr-modal-content {
        background: white;
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        max-width: 380px;
        width: 90%;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }
</style>

<div class="card-table">
    <div class="card-header">
        <div>
            <h5><i class="fas fa-qrcode"></i> Manajemen QR Code Wisata Geosite</h5>
            <small style="color:#64748b; font-size:0.75rem;">7 Titik Geosite Balige-Meat (BALG-001 s/d BALG-007)</small>
        </div>
        <div style="display:flex; gap:10px;">
            <a href="{{ route('qr.index') }}" target="_blank" class="btn-primary" style="background:#0f766e;">
                <i class="fas fa-external-link-alt"></i> Lihat Halaman Publik
            </a>
            <a href="{{ route('admin.qr-destinasi.create') }}" class="btn-primary">
                <i class="fas fa-plus"></i> Tambah Titik QR
            </a>
        </div>
    </div>

    @if(session('success'))
    <div style="background:#e8f5e9; color:#2e7d32; padding:12px 20px; margin:16px 20px; border-radius:12px; border-left:4px solid #2e7d32; display:flex; align-items:center; gap:10px; font-size:0.85rem;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>QR Code</th>
                    <th>Destinasi</th>
                    <th>Kategori</th>
                    <th>Scan / Views</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <span class="qr-badge">{{ $item->kode }}</span>
                    </td>
                    <td>
                        <div class="qr-thumb-box" title="Klik untuk memperbesar & download" onclick="showQrModal('{{ $item->kode }}', '{{ $item->nama }}', '{{ route('qr.show', $item->kode) }}')">
                            <div id="qr-mini-{{ $item->kode }}"></div>
                        </div>
                    </td>
                    <td>
                        <div style="display:flex; align-items:center; gap:12px;">
                            <img src="{{ $item->gambar_url }}" alt="{{ $item->nama }}" style="width:45px; height:45px; object-fit:cover; border-radius:8px;" onerror="this.onerror=null; this.src='{{ asset('image/default.jpg') }}'">
                            <div>
                                <strong style="color:#003366; font-size:0.9rem;">{{ $item->nama }}</strong>
                                <div style="color:#64748b; font-size:0.75rem;"><i class="fas fa-map-marker-alt"></i> {{ Str::limit($item->lokasi ?: 'Danau Toba', 35) }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="background:#f1f5f9; padding:4px 10px; border-radius:20px; font-size:0.75rem; font-weight:600; color:#475569;">
                            {{ $item->kategori }}
                        </span>
                    </td>
                    <td>
                        <span style="font-weight:700; color:#003366;"><i class="fas fa-eye" style="color:var(--gold);"></i> {{ number_format($item->views) }}</span>
                    </td>
                    <td>
                        <label class="switch-toggle">
                            <input type="checkbox" onchange="toggleStatus({{ $item->id }})" {{ $item->status ? 'checked' : '' }}>
                            <span class="slider-toggle"></span>
                        </label>
                    </td>
                    <td>
                        <div class="btn-action-group">
                            <a href="{{ route('qr.show', $item->kode) }}" target="_blank" class="btn-action-btn btn-action-view" title="Kunjungi Halaman">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.qr-destinasi.print', $item->id) }}" target="_blank" class="btn-action-btn btn-action-print" title="Cetak Standee / Plakat QR">
                                <i class="fas fa-print"></i> Cetak
                            </a>
                            <a href="{{ route('admin.qr-destinasi.edit', $item->id) }}" class="btn-action-btn btn-action-edit" title="Edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.qr-destinasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus titik QR {{ $item->kode }}?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action-btn btn-action-delete" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding:50px; color:#94a3b8;">
                        <i class="fas fa-qrcode" style="font-size:2rem; margin-bottom:10px; display:block;"></i>
                        Belum ada data destinasi QR Code.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($data->hasPages())
    <div style="padding:16px 20px; background:#f8fafc; border-top:1px solid #e2e8f0;">
        {{ $data->links() }}
    </div>
    @endif
</div>

{{-- MODAL PREVIEW QR CODE & DOWNLOAD --}}
<div class="qr-modal" id="qrModal" onclick="closeQrModal(event)">
    <div class="qr-modal-content">
        <h4 id="modalQrTitle" style="color:#003366; font-weight:800; margin-bottom:4px;"></h4>
        <div id="modalQrBadge" style="display:inline-block; margin-bottom:16px;" class="qr-badge"></div>
        <div id="modalQrCanvas" style="display:flex; justify-content:center; margin:16px 0;"></div>
        <p style="font-size:0.75rem; color:#64748b; word-break:break-all;" id="modalQrUrl"></p>
        <div style="display:flex; gap:10px; justify-content:center; margin-top:20px;">
            <button type="button" onclick="downloadModalQr()" class="btn-primary" style="background:#16a34a;">
                <i class="fas fa-download"></i> Download QR PNG
            </button>
            <button type="button" onclick="closeQrModalDirect()" class="btn-primary" style="background:#64748b;">
                Tutup
            </button>
        </div>
    </div>
</div>

{{-- SCRIPT GENERATOR QR CODE JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($data as $item)
        new QRCode(document.getElementById("qr-mini-{{ $item->kode }}"), {
            text: "{{ route('qr.show', $item->kode) }}",
            width: 50,
            height: 50,
            colorDark : "#003366",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.M
        });
        @endforeach
    });

    let currentModalQrCode = '';

    function showQrModal(kode, nama, url) {
        currentModalQrCode = kode;
        document.getElementById('modalQrTitle').innerText = nama;
        document.getElementById('modalQrBadge').innerText = kode;
        document.getElementById('modalQrUrl').innerText = url;

        const canvasContainer = document.getElementById('modalQrCanvas');
        canvasContainer.innerHTML = '';
        new QRCode(canvasContainer, {
            text: url,
            width: 220,
            height: 220,
            colorDark : "#003366",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });

        document.getElementById('qrModal').classList.add('active');
    }

    function closeQrModal(e) {
        if (e.target.id === 'qrModal') {
            closeQrModalDirect();
        }
    }

    function closeQrModalDirect() {
        document.getElementById('qrModal').classList.remove('active');
    }

    function downloadModalQr() {
        const canvas = document.querySelector('#modalQrCanvas canvas');
        if (canvas) {
            const image = canvas.toDataURL("image/png");
            const link = document.createElement('a');
            link.download = 'QR_' + currentModalQrCode + '.png';
            link.href = image;
            link.click();
        } else {
            const img = document.querySelector('#modalQrCanvas img');
            if (img) {
                const link = document.createElement('a');
                link.download = 'QR_' + currentModalQrCode + '.png';
                link.href = img.src;
                link.click();
            }
        }
    }

    function toggleStatus(id) {
        fetch(`/admin/qr-destinasi/toggle-status/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                console.log('Status updated');
            }
        });
    }
</script>

@endsection