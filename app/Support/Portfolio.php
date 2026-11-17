<?php

namespace App\Support;

/**
 * Data proyek yang sudah berjalan di produksi.
 * Dipakai oleh halaman beranda dan halaman /proyek agar isinya konsisten.
 */
class Portfolio
{
    public static array $projects = [
        [
            'slug'        => 'mulaisekarang',
            'name'        => 'Mulaisekarang',
            'category'    => 'Platform belajar online',
            'url'         => 'https://mulaisekarang.com',
            'summary'     => 'Platform kursus daring lengkap dengan katalog kelas, pembayaran, sertifikat, percakapan real-time antara pengajar dan peserta, serta penjadwalan konsultasi.',
            'scope'       => [
                'Katalog kursus, keranjang, dan checkout',
                'Sertifikat otomatis setelah kelas selesai',
                'Chat real-time dan lampiran berkas',
                'Panel admin untuk pengajar dan operasional',
            ],
            'stack'       => ['Laravel', 'MySQL', 'Redis', 'Docker', 'Cloudflare'],
        ],
        [
            'slug'        => 'study-center-nias',
            'name'        => 'Study Center Nias',
            'category'    => 'Sistem manajemen pembelajaran',
            'url'         => 'https://studycenter.nanoprojectdevindonesia.com',
            'summary'     => 'LMS untuk lembaga pendidikan: pengelolaan kelas dan materi, penugasan, serta komunikasi kelas melalui kanal real-time berbasis WebSocket.',
            'scope'       => [
                'Manajemen kelas, materi, dan penugasan',
                'Notifikasi dan chat kelas real-time',
                'Peran pengajar, siswa, dan administrator',
                'Deploy mandiri dengan Nginx dan PHP-FPM',
            ],
            'stack'       => ['Laravel', 'Reverb', 'MySQL', 'Nginx'],
        ],
        [
            'slug'        => 'nanohub',
            'name'        => 'NanoHub',
            'category'    => 'SaaS otomasi pesan',
            'url'         => 'https://nanohub.nanoprojectdevindonesia.com',
            'summary'     => 'Aplikasi multi-tenant untuk mengelola banyak nomor WhatsApp: broadcast terjadwal dengan antrian, balasan otomatis berbasis aturan, dan inbox tim.',
            'scope'       => [
                'Koneksi multi-perangkat dan status real-time',
                'Antrian broadcast dengan jeda acak',
                'Inbox CRM dengan penugasan ke anggota tim',
                'Billing, kuota paket, dan kontrol akses berbasis peran',
            ],
            'stack'       => ['Node.js', 'BullMQ', 'Redis', 'React', 'Xendit'],
        ],
        [
            'slug'        => 'jurnal-ykde',
            'name'        => 'Jurnal YKDE',
            'category'    => 'Aplikasi jurnal harian',
            'url'         => 'https://habit-tracker.nanoprojectdevindonesia.com',
            'summary'     => 'Aplikasi pembiasaan dan jurnal harian untuk lingkungan sekolah: pencatatan kegiatan, rekap periodik, dan dasbor pemantauan untuk guru.',
            'scope'       => [
                'Pencatatan jurnal harian yang cepat dipakai',
                'Rekap mingguan dan bulanan',
                'Dasbor guru dan pimpinan',
                'Berjalan di server sendiri dengan tunnel aman',
            ],
            'stack'       => ['Laravel', 'Inertia', 'Vue', 'MySQL'],
        ],
    ];

    public static function findBySlug(string $slug): ?array
    {
        foreach (self::$projects as $project) {
            if ($project['slug'] === $slug) {
                return $project;
            }
        }

        return null;
    }
}
