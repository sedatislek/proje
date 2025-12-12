<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Season;
use App\Models\Discipline;
use App\Models\Category;

class CompetitionController extends Controller
{
    public function index()
    {
        $competitions = Competition::with(['season','discipline','category'])
            ->orderBy('discipline_id')
            ->orderBy('category_id')
            ->orderBy('name')
            ->get();

        // 1. Branşa göre grupla
        $grouped = $competitions->groupBy(function($item){
            return $item->discipline?->name ?? 'Branş Belirsiz';
        });

        // 2. İçinde kız / erkek ayrımı yap
        $grouped = $grouped->map(function($items){

            return $items->groupBy(function($item){

                // kategori adında kız/erkek geçiyorsa otomatik ayırıyoruz
                $cat = mb_strtolower($item->category?->name ?? '');

                if(str_contains($cat, 'kız')) return 'Kız';
                if(str_contains($cat, 'erkek')) return 'Erkek';

                return 'Genel';
            });
        });

        return view('admin.competitions.index', compact('grouped'));
    }


    public function create()
    {
        $seasons = Season::orderBy('season_year')->get();

        // Branşlar (Artistik, Trampolin, Ritmik vb.)
        $disciplines = Discipline::orderBy('name')->get();

        // Kategoriler (Küçük Kız, Küçük Erkek, Yıldız Kız, vb.)
        $categories = Category::orderBy('name')->get();

        // Yarışma türleri — Türkçe hale getirildi
        $types = [
            'official_national' => 'Resmi – Ulusal',
            'official_regional' => 'Resmi – Bölgesel',
            'official_local'    => 'Resmi – Yerel',
            'international'     => 'Uluslararası',
            'friendly'          => 'Dostluk Turnuvası',
            'qualification'     => 'Eleme Yarışması',
            'finals'            => 'Final Yarışması',
            'championship'      => 'Şampiyona',
            'cup'               => 'Kupası',
            'festival'          => 'Festival',
        ];

        return view('admin.competitions.create', compact(
            'seasons','disciplines','categories','types'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'season_id'=>'nullable|exists:seasons,season_id',
            'discipline_id'=>'nullable|exists:disciplines,discipline_id',
            'category_id'=>'nullable|exists:categories,category_id',
            'competition_type'=>'required|string',
            'is_team_event'=>'nullable|boolean',
        ]);

        Competition::create([
            'name'=>$request->name,
            'season_id'=>$request->season_id,
            'discipline_id'=>$request->discipline_id,
            'category_id'=>$request->category_id,
            'competition_type'=>$request->competition_type,
            'is_team_event'=> (bool)$request->is_team_event,
        ]);

        return redirect()->route('admin.competitions.index')->with('success','Yarışma oluşturuldu.');
    }

    public function edit($id)
    {
        $competition = Competition::findOrFail($id);
        $seasons = Season::orderBy('season_year')->get();
        $disciplines = Discipline::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $types = [
            'official_national','official_regional','official_local',
            'international','friendly','club_internal','qualification',
            'finals','championship','cup','festival'
        ];
        return view('admin.competitions.edit', compact('competition','seasons','disciplines','categories','types'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'season_id'=>'nullable|exists:seasons,season_id',
            'discipline_id'=>'nullable|exists:disciplines,discipline_id',
            'category_id'=>'nullable|exists:categories,category_id',
            'competition_type'=>'required|string',
            'is_team_event'=>'nullable|boolean',
        ]);

        $comp = Competition::findOrFail($id);
        $comp->update([
            'name'=>$request->name,
            'season_id'=>$request->season_id,
            'discipline_id'=>$request->discipline_id,
            'category_id'=>$request->category_id,
            'competition_type'=>$request->competition_type,
            'is_team_event'=> (bool)$request->is_team_event,
        ]);

        return redirect()->route('admin.competitions.index')->with('success','Güncellendi.');
    }

    public function destroy($id)
    {
        Competition::findOrFail($id)->delete();
        return redirect()->route('admin.competitions.index')->with('success','Silindi.');
    }
}
