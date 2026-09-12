<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QrDestination;
use App\Helpers\TranslateHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminQrDestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = QrDestination::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('kode', 'LIKE', "%{$search}%")
                  ->orWhere('lokasi', 'LIKE', "%{$search}%")
                  ->orWhere('kategori', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active' ? 1 : 0);
        }

        $data = $query->orderBy('kode', 'asc')->paginate(10)->withQueryString();

        return view('admin.qr-destination.index', compact('data'));
    }

    public function create()
    {
        return view('admin.qr-destination.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:30|unique:qr_destinations,kode',
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi_singkat' => 'nullable|string',
            'deskripsi_lengkap' => 'required|string',
            'lokasi' => 'nullable|string|max:255',
            'google_maps_url' => 'nullable|url',
            'jam_operasional' => 'nullable|string|max:100',
            'harga_tiket' => 'nullable|string|max:100',
            'fasilitas' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'status' => 'nullable|boolean',
        ]);

        $kode = strtoupper(trim($request->kode));
        $namaEn = TranslateHelper::translateToEnglish($request->nama);
        $deskripsiEn = TranslateHelper::translateToEnglish($request->deskripsi_lengkap);

        $payload = [
            'kode' => $kode,
            'nama' => $request->nama,
            'nama_en' => $namaEn,
            'slug' => Str::slug($request->nama) . '-' . strtolower($kode),
            'kategori' => $request->kategori,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'deskripsi_lengkap' => $request->deskripsi_lengkap,
            'deskripsi_lengkap_en' => $deskripsiEn,
            'lokasi' => $request->lokasi,
            'google_maps_url' => $request->google_maps_url,
            'jam_operasional' => $request->jam_operasional,
            'harga_tiket' => $request->harga_tiket,
            'fasilitas' => $request->fasilitas,
            'status' => $request->has('status') ? 1 : 0,
            'views' => 0,
        ];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . strtolower($kode) . '.' . $file->getClientOriginalExtension();
            $destPath = public_path('image/qr-destinations');
            if (!file_exists($destPath)) {
                mkdir($destPath, 0755, true);
            }
            $file->move($destPath, $filename);
            $payload['gambar'] = 'image/qr-destinations/' . $filename;
        }

        QrDestination::create($payload);

        return redirect()->route('admin.qr-destinasi.index')->with('success', 'Destinasi QR Code ' . $kode . ' berhasil ditambahkan!');
    }

    public function show($id)
    {
        $destination = QrDestination::findOrFail($id);
        return view('admin.qr-destination.show', compact('destination'));
    }

    public function edit($id)
    {
        $destination = QrDestination::findOrFail($id);
        return view('admin.qr-destination.edit', compact('destination'));
    }

    public function update(Request $request, $id)
    {
        $destination = QrDestination::findOrFail($id);

        $request->validate([
            'kode' => 'required|string|max:30|unique:qr_destinations,kode,' . $destination->id,
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi_singkat' => 'nullable|string',
            'deskripsi_lengkap' => 'required|string',
            'lokasi' => 'nullable|string|max:255',
            'google_maps_url' => 'nullable|url',
            'jam_operasional' => 'nullable|string|max:100',
            'harga_tiket' => 'nullable|string|max:100',
            'fasilitas' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'status' => 'nullable|boolean',
        ]);

        $kode = strtoupper(trim($request->kode));
        $namaEn = $request->nama === $destination->nama ? $destination->nama_en : TranslateHelper::translateToEnglish($request->nama);
        $deskripsiEn = $request->deskripsi_lengkap === $destination->deskripsi_lengkap ? $destination->deskripsi_lengkap_en : TranslateHelper::translateToEnglish($request->deskripsi_lengkap);

        $payload = [
            'kode' => $kode,
            'nama' => $request->nama,
            'nama_en' => $namaEn,
            'slug' => Str::slug($request->nama) . '-' . strtolower($kode),
            'kategori' => $request->kategori,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'deskripsi_lengkap' => $request->deskripsi_lengkap,
            'deskripsi_lengkap_en' => $deskripsiEn,
            'lokasi' => $request->lokasi,
            'google_maps_url' => $request->google_maps_url,
            'jam_operasional' => $request->jam_operasional,
            'harga_tiket' => $request->harga_tiket,
            'fasilitas' => $request->fasilitas,
            'status' => $request->has('status') ? 1 : 0,
        ];

        if ($request->has('hapus_gambar') && $request->hapus_gambar == 1) {
            if ($destination->gambar && file_exists(public_path($destination->gambar))) {
                @unlink(public_path($destination->gambar));
            }
            $payload['gambar'] = null;
        }

        if ($request->hasFile('gambar')) {
            if ($destination->gambar && file_exists(public_path($destination->gambar))) {
                @unlink(public_path($destination->gambar));
            }
            $file = $request->file('gambar');
            $filename = time() . '_' . strtolower($kode) . '.' . $file->getClientOriginalExtension();
            $destPath = public_path('image/qr-destinations');
            if (!file_exists($destPath)) {
                mkdir($destPath, 0755, true);
            }
            $file->move($destPath, $filename);
            $payload['gambar'] = 'image/qr-destinations/' . $filename;
        }

        $destination->update($payload);

        return redirect()->route('admin.qr-destinasi.index')->with('success', 'Data destinasi QR ' . $kode . ' berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $destination = QrDestination::findOrFail($id);
        if ($destination->gambar && file_exists(public_path($destination->gambar))) {
            @unlink(public_path($destination->gambar));
        }
        $kode = $destination->kode;
        $destination->delete();

        return redirect()->route('admin.qr-destinasi.index')->with('success', 'Data destinasi QR ' . $kode . ' berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $destination = QrDestination::findOrFail($id);
        $destination->status = !$destination->status;
        $destination->save();

        return response()->json([
            'success' => true,
            'status' => $destination->status,
            'message' => 'Status berhasil diubah!'
        ]);
    }

    /**
     * Tampilan cetak / print standee QR Code resmi untuk plakat destinasi.
     */
    public function printCard($id)
    {
        $destination = QrDestination::findOrFail($id);
        return view('admin.qr-destination.print', compact('destination'));
    }
}