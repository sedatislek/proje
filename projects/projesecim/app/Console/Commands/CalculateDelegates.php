<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DelegateCalculator;

class CalculateDelegates extends Command
{
    /**
     * Komutun ismi (CLI'de böyle çalıştırılır)
     */
    protected $signature = 'delegates:calculate {electionYear}';

    /**
     * Komut açıklaması
     */
    protected $description = 'Belirli bir seçim yılı için delegasyon hesaplaması yapar';

    /**
     * Komut çalıştırılınca yapılacaklar
     */
    public function handle(DelegateCalculator $calculator)
    {
        $year = (int) $this->argument('electionYear');
        $this->info("[$year] seçim yılı için delegasyon hesaplanıyor...");
        $rows = $calculator->calculateForElectionYear($year);
        if (empty($rows)) {
            $this->warn("Hiç delegasyon bulunamadı.");
        } else {
            foreach ($rows as $r) {
                $this->line("- {$r['club_name']} | {$r['discipline_name']} | {$r['category_name']} | {$r['season1']}&{$r['season2']}");
            }
        }
        $this->info("Tamamlandı.");
    }

}
