<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['admin_last_page' => url()->current()]);
        
        $floors = Floor::all();
        return view('admin.floors.index', compact('floors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.floors.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lantai' => 'required|string|max:5'
        ]);

        Floor::create($request->all());
        return redirect(session('admin_last_page', route('floors.index')))->with('success', 'Berhasil');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Floor $floor)
    {
        return view('admin.floors.form', compact('floor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Floor $floor)
    {
        $request->validate([
            'lantai' => 'required|string|max:5'
        ]);

        $floor->update($request->all());
        return redirect(session('admin_last_page', route('floors.index')))->with('success', 'Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Floor $floor)
    {
        $floor->delete();
        return redirect(session('admin_last_page', route('floors.index')))->with('success', 'Berhasil');
    }
}
