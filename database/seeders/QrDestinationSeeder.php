<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QrDestination;
use Illuminate\Support\Str;

class QrDestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'kode' => 'BALG-001',
                'nama' => 'Pantai Simanjuntak',
                'nama_en' => 'Simanjuntak Beach',
                'slug' => 'pantai-simanjuntak',
                'kategori' => 'Wisata Alam & Danau',
                'deskripsi_singkat' => 'Pantai pasir putih eksotis di tepian Danau Toba dengan panorama alam menawan dan perairan yang tenang.',
                'deskripsi_lengkap' => 'Pantai Simanjuntak merupakan salah satu destinasi bahari unggulan di kawasan Balige, Danau Toba. Tempat ini menyuguhkan panorama danau vulkanik terbesar di dunia dengan latar belakang perbukitan hijau yang memanjakan mata. Pengunjung dapat menikmati sejuknya hembusan angin danau, berenang di perairan yang aman, bersantai di pondok santai tepi pantai, serta menikmati keindahan matahari terbenam.',
                'deskripsi_lengkap_en' => 'Simanjuntak Beach is a popular lakefront destination in Balige on the shores of Lake Toba, offering stunning panoramic views of volcanic landscapes, calm fresh waters, and tranquil sunset scenery.',
                'lokasi' => 'Lumban Bulbul / Balige, Kabupaten Toba, Sumatera Utara',
                'google_maps_url' => 'https://maps.google.com/?q=Pantai+Simanjuntak+Balige',
                'jam_operasional' => '07.00 - 18.30 WIB',
                'harga_tiket' => 'Rp 5.000 / orang',
                'fasilitas' => 'Gazebo, Kamar Mandi / Toilet, Warung Kuliner Tradisional, Tempat Parkir, Spot Foto Estetik',
                'gambar' => 'image/destinations/alam/1782229622_hero_testing.jpeg',
            ],
            [
                'kode' => 'BALG-002',
                'nama' => 'Goa Liang Sipege',
                'nama_en' => 'Liang Sipege Cave',
                'slug' => 'goa-liang-sipege',
                'kategori' => 'Geosite & Warisan Geologi',
                'deskripsi_singkat' => 'Situs geologi goa alami dengan formasi batuan kapur stalaktit dan stalagmit yang sarat nilai sejarah dan sains.',
                'deskripsi_lengkap' => 'Goa Liang Sipege adalah warisan geologi luar biasa yang menjadi bagian penting dari Geopark Kaldera Toba. Terbentuk dari proses pelarutan batuan kapur selama ribuan tahun, goa ini memiliki lorong eksotis dengan struktur stalaktit dan stalagmit yang menawan. Di masa lampau, goa ini juga memiliki keterikatan historis dan legenda masyarakat lokal Batak sebagai tempat berlindung dan bermusyawarah.',
                'deskripsi_lengkap_en' => 'Liang Sipege Cave is an outstanding geological site featuring limestone formations, stalactites, and stalagmites shaped by centuries of natural weathering in Lake Toba Geopark.',
                'lokasi' => 'Desa Simarmar Pea Talun Hutagaol, Balige, Toba',
                'google_maps_url' => 'https://maps.google.com/?q=Goa+Liang+Sipege+Balige',
                'jam_operasional' => '08.00 - 17.00 WIB',
                'harga_tiket' => 'Rp 10.000 / orang',
                'fasilitas' => 'Pemandu Lokal, Jalur Setapak, Lampu Penerangan Gua, Tempat Parkir, Pos Informasi Geosite',
                'gambar' => 'image/meat/liang-sipege-hero.jpg',
            ],
            [
                'kode' => 'BALG-003',
                'nama' => 'Batu Basiha',
                'nama_en' => 'Batu Basiha Geosite',
                'slug' => 'batu-basiha',
                'kategori' => 'Geosite & Geowisata',
                'deskripsi_singkat' => 'Formasi batuan vulkanik unik menyerupai tiang kayu membatu (columnar joint) dari letusan purba Toba.',
                'deskripsi_lengkap' => 'Batu Basiha (Batu Bahisan) merupakan singkapan batuan basal berbentuk kolom heksagonal (columnar jointing) langka yang tercipta akibat pendinginan magma basaltik secara perlahan pasca erupsi gunung api purba Toba puluhan ribu tahun silam. Legenda lokal mengisahkan bahwa batu-batu ini adalah balok kayu rumah adat yang dikutuk menjadi batu, menjadikannya perpaduan sempurna antara keajaiban geologi dan kearifan lokal.',
                'deskripsi_lengkap_en' => 'Batu Basiha is a unique geological site boasting columnar basalt joint structures formed by the slow cooling of ancient volcanic lava flows from Lake Toba mega-eruptions.',
                'lokasi' => 'Desa Meat / Tampahan, Kabupaten Toba, Sumatera Utara',
                'google_maps_url' => 'https://maps.google.com/?q=Batu+Basiha+Toba',
                'jam_operasional' => '24 Jam (Disarankan 08.00 - 18.00 WIB)',
                'harga_tiket' => 'Gratis / Sukarela',
                'fasilitas' => 'Papan Informasi Geologi, Jalur Trekking, Spot Foto, Area Pandang Alam',
                'gambar' => 'image/meat/batubasiha1.png',
            ],
            [
                'kode' => 'BALG-004',
                'nama' => 'Desa Meat',
                'nama_en' => 'Meat Cultural Village',
                'slug' => 'desa-meat',
                'kategori' => 'Desa Wisata & Budaya',
                'deskripsi_singkat' => 'Desa adat yang asri di lembah tepi danau, sentra tenun Ulos Batak tradisional terkemuka.',
                'deskripsi_lengkap' => 'Desa Meat dijuluki sebagai salah satu desa terindah di Danau Toba yang terletak di lembah ngarai dengan pemandangan sawah terasering berlatar perbukitan dan perairan biru Toba. Desa ini dikenal luas sebagai sentra perajin tenun Ulos tradisional Batak jenis Ragidup dan Sadum. Pengunjung dapat menyaksikan langsung proses pewarnaan alami serta penenunan ulos oleh para inang (ibu-ibu penenun) di pelataran rumah adat Batak kuno.',
                'deskripsi_lengkap_en' => 'Meat Village is a picturesque cultural village located in a valley along Lake Toba, renowned as a living heritage center for traditional Batak handwoven Ulos textiles.',
                'lokasi' => 'Kecamatan Tampahan, Kabupaten Toba, Sumatera Utara',
                'google_maps_url' => 'https://maps.google.com/?q=Desa+Wisata+Meat+Toba',
                'jam_operasional' => 'Buka Setiap Hari (08.00 - 18.00 WIB)',
                'harga_tiket' => 'Gratis',
                'fasilitas' => 'Homestay / Penginapan Warga, Sentra Souvenir Ulos, Warung Kopi & Kuliner, Pemandu Budaya',
                'gambar' => 'image/meat/meat-detail.jpg',
            ],
            [
                'kode' => 'BALG-005',
                'nama' => 'Pantai Meat 2',
                'nama_en' => 'Meat Beach 2',
                'slug' => 'pantai-meat-2',
                'kategori' => 'Wisata Alam & Camping',
                'deskripsi_singkat' => 'Tepian pantai danau alami dengan hamparan rumput hijau, lokasi favorit untuk camping dan bersantai.',
                'deskripsi_lengkap' => 'Pantai Meat 2 adalah lanjutan dari kawasan pesisir Desa Meat yang menawarkan suasana lebih tenang, privat, dan menyatu dengan alam. Dengan tepian pantai berpasir halus dan padang rumput hijau yang luas di bibir danau, tempat ini menjadi lokasi favorit wisatawan untuk berkemah (camping ground), mengadakan api unggun, piknik keluarga, serta fotografi lanskap.',
                'deskripsi_lengkap_en' => 'Meat Beach 2 offers a serene and lush waterfront retreat along Lake Toba, popular for outdoor camping, lakeside picnics, and breathtaking sunrise views.',
                'lokasi' => 'Pesisir Desa Meat, Kec. Tampahan, Kabupaten Toba',
                'google_maps_url' => 'https://maps.google.com/?q=Pantai+Meat+Toba',
                'jam_operasional' => '24 Jam',
                'harga_tiket' => 'Rp 5.000 / orang (Camping: Rp 25.000)',
                'fasilitas' => 'Camping Ground, Tempat Api Unggun, Kamar Mandi, Penyewaan Tenda, Kios Makanan Ringan',
                'gambar' => 'image/meat/danau.jpg',
            ],
            [
                'kode' => 'BALG-006',
                'nama' => 'IT-DEL',
                'nama_en' => 'Del Institute of Technology (IT Del)',
                'slug' => 'it-del',
                'kategori' => 'Wisata Edukasi & Teknologi',
                'deskripsi_singkat' => 'Institut teknologi terkemuka dengan kampus modern berstandar internasional di tepi Danau Toba.',
                'deskripsi_lengkap' => 'Institut Teknologi Del (IT Del) didirikan oleh Jenderal TNI (Purn.) Luhut Binsar Pandjaitan pada tahun 2001. Berdiri megah di tepian Danau Toba, kampus ini menjadi pusat keunggulan pendidikan tinggi di bidang rekayasa perangkat lunak, bioteknologi, sistem informasi, dan teknologi modern di Indonesia. Desain arsitektur kampus yang berwawasan lingkungan menyatu harmonis dengan keindahan alam sekitarnya.',
                'deskripsi_lengkap_en' => 'Del Institute of Technology (IT Del) is a prestigious higher education institution nestled beside Lake Toba, pioneering technology, engineering, and digital science education in Indonesia.',
                'lokasi' => 'Jl. Sisingamangaraja, Sitoluama, Laguboti / Balige, Toba',
                'google_maps_url' => 'https://maps.google.com/?q=Institut+Teknologi+Del+Sitoluama',
                'jam_operasional' => '08.00 - 17.00 WIB (Sesuai Izin Kunjungan)',
                'harga_tiket' => 'Kunjungan Edukasi / Konfirmasi Kampus',
                'fasilitas' => 'Perpustakaan Digital, Auditorium, Laboratorium Komputer, Kantin Kampus, Area Parkir Luas',
                'gambar' => 'image/logo/del.jpg',
            ],
            [
                'kode' => 'BALG-007',
                'nama' => 'Museum TB Silalahi',
                'nama_en' => 'TB Silalahi Center Museum',
                'slug' => 'museum-tb-silalahi',
                'kategori' => 'Wisata Budaya & Sejarah',
                'deskripsi_singkat' => 'Pusat kebudayaan dan museum Batak terlengkap dengan koleksi artefak kuno dan arsitektur megah.',
                'deskripsi_lengkap' => 'Museum TB Silalahi Center merupakan kompleks museum megah dan terpadu yang memadukan sejarah militer Letjen (Purn) Dr. TB Silalahi dengan Museum Batak yang memuat artefak budaya 6 sub-etnis Batak (Toba, Karo, Simalungun, Mandailing, Angkola, dan Pakpak). Di sini pengunjung dapat menyaksikan miniatur perkampungan Batak asli (Huta Batak), replika patung Sigale-gale, senjata pusaka, serta naskah kuno beraksara Batak.',
                'deskripsi_lengkap_en' => 'TB Silalahi Center is an iconic cultural museum complex preserving rich Batak ancestral artifacts, traditional Huta settlements, historical heirlooms, and comprehensive heritage archives.',
                'lokasi' => 'Jl. Pagar Batu No. 88, Silalahi Pagar Batu, Balige, Kabupaten Toba',
                'google_maps_url' => 'https://maps.google.com/?q=TB+Silalahi+Center+Museum+Batak+Balige',
                'jam_operasional' => '08.00 - 17.00 WIB (Selasa - Minggu)',
                'harga_tiket' => 'Rp 20.000 / orang',
                'fasilitas' => 'Gedung Museum Ber-AC, Huta Batak, Toko Suvenir, Kafe & Restoran, Convention Hall, Toilet Bersih, Parkir Bus',
                'gambar' => 'image/meat/Jabubatak.jpg',
            ],
        ];

        foreach ($destinations as $dest) {
            QrDestination::updateOrCreate(
                ['kode' => $dest['kode']],
                $dest
            );
        }
    }
}
