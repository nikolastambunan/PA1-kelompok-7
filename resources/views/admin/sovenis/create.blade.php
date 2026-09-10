@extends('layouts.admin')

@section('title', 'Tambah Sovenis')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow border-0 rounded-4">

                <!-- Header -->
                <div class="card-header bg-success text-white rounded-top-4 py-3">
                    <div class="d-flex align-items-center">
                        <div>
                            <h4 class="mb-0 fw-bold">
                                Tambah Data Sovenis
                            </h4>
                            <small>
                                Lengkapi informasi sovenis dengan benar
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body p-4">

                    <form action="{{ route('admin.sovenis.store') }}" 
                          method="POST" 
                          enctype="multipart/form-data">

                        @csrf

                        <!-- Nama Sovenis -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Nama Sovenis
                            </label>

                            <input type="text" 
                                   name="nama"
                                   class="form-control rounded-3"
                                   placeholder="Masukkan nama sovenis"
                                   required>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Deskripsi
                            </label>

                            <textarea name="deskripsi"
                                      class="form-control rounded-3"
                                      rows="5"
                                      placeholder="Masukkan deskripsi sovenis"
                                      required></textarea>
                        </div>

                        <!-- Harga & Urutan -->
                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">
                                    Harga
                                </label>

                                <input type="text"
                                       name="harga"
                                       class="form-control rounded-3"
                                       placeholder="Masukkan harga sovenis (misal: Rp 50.000)">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">
                                    Urutan Tampil
                                </label>

                                <input type="number"
                                       name="urutan"
                                       class="form-control rounded-3"
                                       placeholder="Masukkan nomor urutan"
                                       required>
                                <small class="text-muted">
                                    Semakin kecil angka, semakin atas tampilannya.
                                </small>
                            </div>

                        </div>

                        <!-- Upload Gambar -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Upload Gambar
                            </label>

                            <div class="border rounded-4 p-3 bg-light">

                                <input type="file"
                                       name="gambar"
                                       class="form-control rounded-3"
                                       accept="image/*"
                                       id="inputGambar">

                                <small class="text-muted">
                                    Format gambar: JPG, PNG, JPEG
                                </small>

                                <!-- Preview -->
                                <div class="mt-4 text-center"
                                     id="previewContainer"
                                     style="display: none;">

                                    <p class="text-muted mb-2">
                                        Preview Gambar
                                    </p>

                                    <img id="previewImage"
                                         class="img-fluid rounded-4 shadow-sm border"
                                         style="max-width: 220px;">

                                </div>

                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">

                            <div class="form-check form-switch">

                                <input class="form-check-input"
                                       type="checkbox"
                                       name="status"
                                       value="1"
                                       id="statusSwitch"
                                       checked>

                                <label class="form-check-label fw-semibold"
                                       for="statusSwitch">
                                    Aktifkan Sovenis
                                </label>

                            </div>

                        </div>

                        <!-- Button -->
                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('admin.sovenis.index') }}"
                               class="btn btn-outline-secondary rounded-3 px-4">
                                Batal
                            </a>

                            <button type="submit"
                                    class="btn btn-success rounded-3 px-4">
                                Simpan Data
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Preview Image -->
<script>
    document.getElementById('inputGambar')?.addEventListener('change', function(e) {

        const file = e.target.files[0];
        const preview = document.getElementById('previewContainer');
        const previewImg = document.getElementById('previewImage');

        if (file) {

            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(file);

        } else {

            preview.style.display = 'none';

        }
    });
</script>
@endsection
