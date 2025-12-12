<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Artisan komutlarını burada kaydediyoruz.
     */
    protected $commands = [
        \App\Console\Commands\CalculateDelegates::class,
    ];

    /**
     * Zamanlanmış görevler
     */
    protected function schedule(Schedule $schedule): void
    {
        // Şimdilik boş bırakıyoruz.
    }

    /**
     * Uygulamaya dahil edilen komutlar
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
