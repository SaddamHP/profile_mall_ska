<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['admin_last_page' => url()->current()]);

        $facilities = Facility::with('floor')->get();
        return view('admin.facilities.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $floors = Floor::all();
        return view('admin.facilities.form', compact('floors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_floor' => 'required|exists:floors,id_floor',
            'nama_facility' => 'required|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|max:2048'
        ]);

        $data = $request->all();
        if($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('facilities', 'public');
        }

        Facility::create($data);
        return redirect(session('admin_last_page', route('facilities.index')))->with('success', 'Berhasil');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $facility)
    {
        $floors = Floor::all();
        return view('admin.facilities.form', compact('facility', 'floors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'id_floor' => 'required|exists:floors,id_floor',
            'nama_facility' => 'required|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|max:2048'
        ]);

        $data = $request->all();
        if($request->hasFile('foto')) {
            if($facility->foto) Storage::disk('public')->delete($facility->foto);
            $data['foto'] = $request->file('foto')->store('facilities', 'public');
        }

        $facility->update($data);
        return redirect(session('admin_last_page', route('facilities.index')))->with('success', 'Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        if($facility->foto) Storage::disk('public')->delete($facility->foto);

        $facility->delete();
        return redirect(session('admin_last_page', route('facilities.index')))->with('success', 'Berhasil');
    }
}
