<?php

namespace App\Services;

use App\Models\Club;
use App\Models\ClubCompetition;
use App\Models\Season;
use App\Models\Discipline;
use App\Models\Category;

class DelegateCalculator
{
    /**
     * Belirli bir seçim yılı için (örn: 2028)
     * Y-2 ve Y-1 sezonlarına göre kulüp oy haklarını hesaplar.
     *
     * DÖNÜŞ:
     * [
     *   [
     *     'club_id'        => ...,
     *     'club_name'      => ...,
     *     'discipline_id'  => ...,
     *     'discipline_name'=> ...,
     *     'category_id'    => ...,
     *     'category_name'  => ...,
     *     'season1'        => 2026,
     *     'season2'        => 2027,
     *     'votes'          => 1,
     *   ],
     *   ...
     * ]
     */
    public function calculateForElectionYear(int $electionYear): array
    {
        // Örn: seçim yılı 2028 ise sezonlar 2026 ve 2027
        $season1Year = $electionYear - 2;
        $season2Year = $electionYear - 1;

        $season1 = Season::where('season_year', $season1Year)->first();
        $season2 = Season::where('season_year', $season2Year)->first();

        if (! $season1 || ! $season2) {
            // Gerekli sezonlar yoksa boş dön
            return [];
        }

        $disciplines = Discipline::all();
        $categories  = Category::all();
        $clubs       = Club::orderBy('club_name')->get();

        $rows = [];

        foreach ($clubs as $club) {
            foreach ($disciplines as $discipline) {
                foreach ($categories as $category) {

                    if (! $this->categoryAllowedForDiscipline($discipline, $category)) {
                        continue;
                    }

                    $hasSeason1 = $this->clubParticipatedInYear(
                        $club,
                        $season1,
                        $discipline,
                        $category
                    );

                    $hasSeason2 = $this->clubParticipatedInYear(
                        $club,
                        $season2,
                        $discipline,
                        $category
                    );

                    // Talimat: ÜST ÜSTE iki sezon aynı branş + kategori = 1 oy
                    if ($hasSeason1 && $hasSeason2) {
                        $rows[] = [
                            'club_id'         => $club->club_id,
                            'club_name'       => $club->club_name,
                            'discipline_id'   => $discipline->discipline_id,
                            'discipline_name' => $discipline->name,
                            'category_id'     => $category->category_id,
                            'category_name'   => $category->name,
                            'season1'         => $season1Year,
                            'season2'         => $season2Year,
                            'votes'           => 1,
                        ];
                    }
                }
            }
        }

        return $rows;
    }

    /**
     * Talimat gereği:
     * - Olimpik branşlar: Küçükler, Yıldızlar, Gençler, Büyükler
     * - Olimpik olmayan: Yıldızlar, Gençler, Büyükler (Küçükler sayılmaz)
     *
     * Bu mantığı kategori isimlerinden (name) okuyoruz.
     */
    protected function categoryAllowedForDiscipline(Discipline $discipline, Category $category): bool
    {
        $name = mb_strtolower($category->name, 'UTF-8');

        if ($discipline->is_olympic) {
            // Olimpik – 4 kategori de dahil
            return in_array($name, ['küçükler', 'yıldızlar', 'gençler', 'büyükler']);
        }

        // Olimpik olmayan – küçükler hariç
        return in_array($name, ['yıldızlar', 'gençler', 'büyükler']);
    }

    /**
     * Kulüp, belirli bir sezonda, belirli branş + kategori için
     * takım halinde yarışmaya katılmış mı?
     *
     * - club_competitions.season_id = sezon
     * - club_competitions.participated = 1
     * - competitions.discipline_id = branş
     * - competitions.category_id = kategori
     * - competitions.is_team_event = 1 (takım halinde yarışma şartı)
     */
    protected function clubParticipatedInYear(
        Club $club,
        Season $season,
        Discipline $discipline,
        Category $category
    ): bool {
        return ClubCompetition::where('club_id', $club->club_id)
            ->where('season_id', $season->season_id)
            ->where('participated', true)
            ->whereHas('competition', function ($q) use ($discipline, $category) {
                $q->where('discipline_id', $discipline->discipline_id)
                    ->where('category_id', $category->category_id)
                    ->where('is_team_event', true);
            })
            ->exists();
    }
}
