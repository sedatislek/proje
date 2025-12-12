<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClubCompetition;
use App\Models\Club;
use App\Models\Competition;
use App\Models\Season;

class ClubCompetitionController extends Controller
{
    public function index(Request $request)
    {
        $query = ClubCompetition::with(['club','competition.discipline','competition.category','season']);

        // Filtreler
        if ($request->season_id) {
            $query->where('season_id', $request->season_id);
        }

        if ($request->discipline_id) {
            $query->whereHas('competition', function($q) use ($request) {
                $q->where('discipline_id', $request->discipline_id);
            });
        }

        if ($request->category_id) {
            $query->whereHas('competition', function($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        if ($request->province) {
            $query->whereHas('club', function($q) use ($request) {
                $q->where('province', $request->province);
            });
        }

        if ($request->club_id) {
            $query->where('club_id', $request->club_id);
        }

        $items = $query->orderBy('id','desc')->paginate(20);

        return view('admin.club_competitions.index', [
            'items'      => $items,
            'seasons'    => \App\Models\Season::orderBy('season_year')->get(),
            'disciplines'=> \App\Models\Discipline::orderBy('name')->get(),
            'categories' => \App\Models\Category::orderBy('name')->get(),
            'provinces'  => \App\Models\Club::select('province')->distinct()->orderBy('province')->get(),
            'clubs'      => \App\Models\Club::orderBy('club_name')->get(),
        ]);
    }

    public function create()
    {
        $clubs = Club::orderBy('club_name')->get();
        $seasons = Season::orderBy('season_year')->get();
        $competitions = Competition::orderBy('name')->get();

        return view('admin.club_competitions.create',
            compact('clubs','competitions','seasons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'club_id'        => 'required|exists:clubs,club_id',
            'season_id'      => 'required|exists:seasons,season_id',
            'competition_id' => 'required|exists:competitions,competition_id',
            'participated'   => 'nullable|boolean',
            'result'         => 'nullable|string|max:100',
        ]);

        ClubCompetition::create([
            'club_id'        => $request->club_id,
            'season_id'      => $request->season_id,
            'competition_id' => $request->competition_id,
            'participated'   => (bool)$request->participated,
            'result'         => $request->result,
        ]);

        return redirect()->route('admin.club-competitions.index')
            ->with('success','Kayıt oluşturuldu.');
    }

    public function edit($id)
    {
        $item = ClubCompetition::findOrFail($id);

        $clubs = Club::orderBy('club_name')->get();
        $seasons = Season::orderBy('season_year')->get();
        $competitions = Competition::orderBy('name')->get();

        return view('admin.club_competitions.edit',
            compact('item','clubs','competitions','seasons'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'club_id'        => 'required|exists:clubs,club_id',
            'season_id'      => 'required|exists:seasons,season_id',
            'competition_id' => 'required|exists:competitions,competition_id',
            'participated'   => 'nullable|boolean',
            'result'         => 'nullable|string|max:100',
        ]);

        $item = ClubCompetition::findOrFail($id);

        $item->update([
            'club_id'        => $request->club_id,
            'season_id'      => $request->season_id,
            'competition_id' => $request->competition_id,
            'participated'   => (bool)$request->participated,
            'result'         => $request->result,
        ]);

        return redirect()->route('admin.club-competitions.index')
            ->with('success','Güncellendi.');
    }

    public function destroy($id)
    {
        ClubCompetition::findOrFail($id)->delete();

        return redirect()->route('admin.club-competitions.index')
            ->with('success','Silindi.');
    }
}
