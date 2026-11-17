<?php

/**
 * Satu sumber data kontak perusahaan.
 * Semua tampilan situs, schema.org, email keluar, dan notifikasi
 * membaca nilai dari sini agar tidak ada nomor/alamat yang tertinggal.
 */
return [

    'name' => 'Nano Project Dev Indonesia',
    'short_name' => 'NPDI',

    'email' => env('COMPANY_EMAIL', 'info@nanoprojectdevindonesia.com'),
    'sales_email' => env('COMPANY_SALES_EMAIL', 'sales@nanoprojectdevindonesia.com'),
    'support_email' => env('COMPANY_SUPPORT_EMAIL', 'support@nanoprojectdevindonesia.com'),

    'phone_display' => env('COMPANY_PHONE_DISPLAY', '+62 821-7908-183'),
    'phone_e164' => env('COMPANY_PHONE_E164', '628217908183'),

    'whatsapp_url' => 'https://wa.me/'.env('COMPANY_PHONE_E164', '628217908183'),

    'instagram' => 'https://instagram.com/seriusman0',

    'address' => [
        'street' => 'Lahemo, Gido',
        'locality' => 'Kabupaten Nias',
        'region' => 'Sumatera Utara',
        'country' => 'ID',
    ],

];
