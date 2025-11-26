<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['admin_last_page' => url()->current()]);

        $events = Event::with('floor')->get();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $floors = Floor::all();
        return view('admin.events.form', compact('floors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_floor' => 'required|exists:floors,id_floor',
            'nama_event' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date_format:Y-m-d\TH:i',
            'tanggal_selesai' => 'required|date_format:Y-m-d\TH:i|after_or_equal:tanggal_mulai',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|max:2048',
        ]);

        $data = $request->all();
        if($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('events', 'public');
        }

        Event::create($data);
        return redirect(session('admin_last_page', route('events.index')))->with('success', 'Berhasil');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $floors = Floor::all();
        return view('admin.events.form', compact('event', 'floors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'id_floor' => 'required|exists:floors,id_floor',
            'nama_event' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date_format:Y-m-d\TH:i',
            'tanggal_selesai' => 'required|date_format:Y-m-d\TH:i|after_or_equal:tanggal_mulai',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if($request->hasFile('gambar')) {
            if($event->gambar) Storage::disk('public')->delete($event->gambar);
            $data['gambar'] = $request->file('gambar')->store('events', 'public');
        }

        $event->update($data);
        return redirect(session('admin_last_page', route('events.index')))->with('success', 'Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if($event->gambar) Storage::disk('public')->delete($event->gambar);
        $event->delete();
        return redirect(session('admin_last_page', route('events.index')))->with('success', 'Berhasil');
    }
}
