<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DelegateCalculator;
use App\Models\Club;
use App\Models\ClubCompetition;
use App\Models\Season;
use App\Models\Delegate;

class AdminController extends Controller
{
    public function dashboard()
    {
        $clubCount = \App\Models\Club::count();
        $competitionCount = \App\Models\Competition::count();
        $participationCount = \App\Models\ClubCompetition::count();

        // Toplam oy hakkı
        $totalVotes = \App\Models\Delegate::count();

        // İl bazlı toplam delegeler
        $delegatesByProvince = \App\Models\Delegate::with('club')
            ->get()
            ->groupBy(fn($d) => $d->club->province ?? 'Bilinmeyen')
            ->map(fn($group) => $group->count())
            ->sortDesc();

        // Kulüp bazlı delegeler
        $delegatesByClub = \App\Models\Delegate::with('club')
            ->get()
            ->groupBy('club_id')
            ->map(function ($group) {
                return [
                    'club_name' => $group->first()->club->club_name ?? 'Bilinmeyen Kulüp',
                    'province'  => $group->first()->club->province ?? '',
                    'count'     => $group->count()
                ];
            })
            ->sortByDesc('count');

        return view('admin.dashboard', compact(
            'clubCount',
            'competitionCount',
            'participationCount',
            'totalVotes',
            'delegatesByProvince',
            'delegatesByClub'
        ));
    }

    // delegasyon kuralları sayfası
    public function votingRights()
    {
        return view('admin.delegates.voting-rights');
    }

    // Delegasyon hesaplama formu (GET)
    public function calculateDelegates()
    {
        $seasons = Season::orderBy('season_year')->get();
        return view('admin.delegates.calculate', compact('seasons'));
    }

    // Delegasyon hesaplamayı çalıştır (POST) -- DelegateCalculator kullanır
    public function runDelegateCalculation(Request $request, DelegateCalculator $calculator)
    {
        $request->validate([
            'election_year' => 'required|integer|min:2025|max:2100',
        ]);

        $electionYear = (int)$request->input('election_year');

        // Hesaplama servisi
        $rows = $calculator->calculateForElectionYear($electionYear);

        // (İsteğe bağlı) Önceki aynı election_year kayıtlarını siliyoruz.
        // Not: delegates tablosunda season1/season2 tutuyoruz; election_year kullanılmıyor
        // Dolayısıyla istersen burada dönemler üzerinden silme yapabilirsin:
        $s1 = $electionYear - 2;
        $s2 = $electionYear - 1;
        Delegate::where('season1', $s1)->where('season2', $s2)->delete();

        // Yeni delegasyonları kaydet
        foreach ($rows as $r) {
            Delegate::create([
                'club_id' => $r['club_id'],
                'season1' => $r['season1'],
                'season2' => $r['season2'],
                'delegate_type' => 'normal',
                'category_id' => $r['category_id'],
            ]);
        }

        return redirect()->route('admin.delegates.index')->with('success', 'Delegasyon hesaplaması tamamlandı. '.count($rows).' delege kaydı oluşturuldu.');
    }

    // Delegasyon sonuçlarını listeleme (DB'den okunur)
    public function delegateVotes()
    {
        // Delegates modeli ile ilişkili club bilgisi
        $delegates = Delegate::with('club')->orderBy('season1','desc')->get();
        return view('admin.delegates.delegates', compact('delegates'));
    }
}
