<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['admin_last_page' => url()->current()]);

        $profiles = Profile::all();
        return view('admin.profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.profiles.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mall' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|max:2048'
        ]);

        $data = $request->all();
        if($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('profiles', 'public');
        }

        Profile::create($data);
        return redirect(session('admin_last_page', route('profiles.index')))->with('success', 'Berhasil');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        return view('admin.profiles.form', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $data = $request->validate([
            'nama_mall' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if($request->hasFile('gambar')) {
            if($profile->gambar) \Storage::disk('public')->delete($profile->gambar);
            $data['gambar'] = $request->file('gambar')->store('profiles', 'public');
        }

        $profile->update($data);
        return redirect(session('admin_last_page', route('profiles.index')))->with('success', 'Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        if($profile->gambar) \Storage::disk('public')->delete($profile->gambar);
        $profile->delete();
        return redirect(session('admin_last_page', route('profiles.index')))->with('success', 'Berhasil');
    }
}
