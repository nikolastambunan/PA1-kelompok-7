<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sovenis;
use Illuminate\Http\Request;

class SovenisController extends Controller
{
    public function index()
    {
        $data = Sovenis::orderBy('urutan')->paginate(10);
        return view('admin.sovenis.index', compact('data'));
    }

    public function create()
    {
        return view('admin.sovenis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'harga' => 'nullable|string|max:255',
            'urutan' => 'required|integer',
            'status' => 'nullable|boolean'
        ]);

        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'urutan' => $request->urutan,
            'status' => $request->has('status') ? 1 : 0
        ];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $imageData = base64_encode(file_get_contents($file));
            $extension = $file->getClientOriginalExtension();
            $data['gambar'] = 'data:image/' . $extension . ';base64,' . $imageData;
        }

        Sovenis::create($data);
        return redirect()->route('admin.sovenis.index')->with('success', 'Sovenis berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = Sovenis::findOrFail($id);
        return view('admin.sovenis.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Sovenis::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'harga' => 'nullable|string|max:255',
            'urutan' => 'required|integer',
            'status' => 'nullable|boolean'
        ]);

        $input = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'urutan' => $request->urutan,
            'status' => $request->has('status') ? 1 : 0
        ];

        if ($request->has('hapus_gambar')) {
            $input['gambar'] = null;
        }

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $imageData = base64_encode(file_get_contents($file));
            $extension = $file->getClientOriginalExtension();
            $input['gambar'] = 'data:image/' . $extension . ';base64,' . $imageData;
        }

        $data->update($input);
        return redirect()->route('admin.sovenis.index')->with('success', 'Sovenis berhasil diupdate!');
    }

    public function destroy($id)
    {
        $data = Sovenis::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.sovenis.index')->with('success', 'Sovenis berhasil dihapus!');
    }
}
