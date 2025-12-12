<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;

class ClubController extends Controller
{
    public function index()
    {
        // Kulüpleri il → kulüpler listesi şeklinde grupla
        $grouped = Club::orderBy('province')
            ->orderBy('club_name')
            ->get()
            ->groupBy('province');

        return view('admin.clubs.index', compact('grouped'));
    }

    public function create()
    {
        return view('admin.clubs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'club_name' => 'required|string|max:255',
            'province'  => 'nullable|string|max:100',
        ]);

        Club::create([
            'club_name' => $request->club_name,
            'province'  => $request->province,
            'is_active' => true,
        ]);

        return redirect()->route('admin.clubs.index')
            ->with('success','Kulüp oluşturuldu.');
    }

    public function edit($id)
    {
        $club = Club::findOrFail($id);
        return view('admin.clubs.edit', compact('club'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'club_name' => 'required|string|max:255',
            'province'  => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
        ]);

        $club = Club::findOrFail($id);

        $club->update([
            'club_name' => $request->club_name,
            'province'  => $request->province,
            'is_active' => $request->has('is_active') ? (bool)$request->is_active : true,
        ]);

        return redirect()->route('admin.clubs.index')
            ->with('success','Kulüp güncellendi.');
    }

    public function destroy($id)
    {
        Club::findOrFail($id)->delete();

        return redirect()->route('admin.clubs.index')
            ->with('success','Silindi.');
    }
}
