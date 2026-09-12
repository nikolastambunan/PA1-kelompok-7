<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Plakat QR - {{ $destination->kode }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { background: #f1f5f9; display: flex; flex-direction: column; align-items: center; padding: 40px 20px; }
        
        .no-print-toolbar {
            margin-bottom: 24px;
            display: flex;
            gap: 12px;
        }

        .btn-print {
            background: #003366;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* CARD PLAKAT STANDEE AKRILIK RESMI */
        .standee-card {
            width: 380px;
            background: white;
            border-radius: 24px;
            border: 3px solid #003366;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            text-align: center;
        }

        .standee-header {
            background: linear-gradient(135deg, #001f3f 0%, #003366 100%);
            color: white;
            padding: 24px 20px 20px;
            position: relative;
        }

        .standee-brand {
            font-size: 1.2rem;
            font-weight: 900;
            letter-spacing: 1px;
            color: white;
        }
        .standee-brand span { color: #c6a43b; }

        .standee-subtitle {
            font-size: 0.72rem;
            color: #cbd5e1;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-top: 4px;
        }

        .standee-body {
            padding: 24px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .standee-code-pill {
            background: #003366;
            color: white;
            font-weight: 800;
            font-size: 0.85rem;
            padding: 6px 18px;
            border-radius: 30px;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
        }

        .standee-title {
            font-size: 1.35rem;
            font-weight: 800;
            color: #003366;
            margin-bottom: 6px;
            line-height: 1.2;
        }

        .standee-cat {
            font-size: 0.75rem;
            font-weight: 700;
            color: #c6a43b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 18px;
        }

        .qr-frame {
            padding: 12px;
            border: 2px dashed #003366;
            border-radius: 16px;
            background: #fafafa;
            margin-bottom: 18px;
        }

        .scan-instruction {
            font-size: 0.82rem;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 4px;
        }

        .scan-instruction-sub {
            font-size: 0.72rem;
            color: #64748b;
            margin-bottom: 12px;
        }

        .standee-footer {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 12px 16px;
            font-size: 0.68rem;
            color: #64748b;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        @media print {
            body { background: white; padding: 0; }
            .no-print-toolbar { display: none; }
            .standee-card { box-shadow: none; border: 2px solid #003366; page-break-inside: avoid; }
        }
    </style>
</head>
<body>

    <div class="no-print-toolbar">
        <button onclick="window.print()" class="btn-print">
            <i class="fas fa-print"></i> Cetak Dokumen / Simpan PDF
        </button>
        <button onclick="window.close()" class="btn-print" style="background:#64748b;">
            Tutup
        </button>
    </div>

    <div class="standee-card">
        <div class="standee-header">
            <div class="standee-brand">Geo<span>Toba</span></div>
            <div class="standee-subtitle">UNESCO Global Geopark Kaldera Toba</div>
        </div>

        <div class="standee-body">
            <div class="standee-code-pill">{{ $destination->kode }}</div>
            <h2 class="standee-title">{{ $destination->nama }}</h2>
            <div class="standee-cat">{{ $destination->kategori }}</div>

            <div class="qr-frame">
                <div id="qrcodeBox"></div>
            </div>

            <div class="scan-instruction">
                <i class="fas fa-camera" style="color:#003366;"></i> Scan Dengan Kamera HP Anda
            </div>
            <div class="scan-instruction-sub">
                Untuk membuka narasi geosite, rute Google Maps & fasilitas
            </div>
        </div>

        <div class="standee-footer">
            <span>Balige - Meat Geosite Site</span>
            <span>ID: {{ $destination->kode }}</span>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        new QRCode(document.getElementById("qrcodeBox"), {
            text: "{{ route('qr.show', $destination->kode) }}",
            width: 200,
            height: 200,
            colorDark : "#003366",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    </script>
</body>
</html>