<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qr_destinations', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 30)->unique();
            $table->string('nama');
            $table->string('nama_en')->nullable();
            $table->string('slug')->unique();
            $table->string('kategori')->default('Geosite');
            $table->text('deskripsi_singkat')->nullable();
            $table->longText('deskripsi_lengkap');
            $table->longText('deskripsi_lengkap_en')->nullable();
            $table->string('lokasi')->nullable();
            $table->text('google_maps_url')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->string('harga_tiket')->nullable();
            $table->string('fasilitas')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_destinations');
    }
};
