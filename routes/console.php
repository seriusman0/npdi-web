<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Laporan harian situs ke Telegram, setiap 20.00 WIB.
Schedule::command('report:daily')
    ->dailyAt('20:00')
    ->timezone('Asia/Jakarta')
    ->withoutOverlapping();

// Balasan WhatsApp otomatis untuk pesan yang tidak ditanggapi.
Schedule::command('wa:auto-reply')
    ->everyMinute()
    ->withoutOverlapping();
