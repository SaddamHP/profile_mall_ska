<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['admin_last_page' => url()->current()]);

        $promos = Promo::with('tenant')->get();
        return view('admin.promos.index', compact('promos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tenants = Tenant::all();
        return view('admin.promos.form', compact('tenants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_tenant' => 'required|exists:tenants,id_tenant',
            'nama_promo' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date_format:Y-m-d\TH:i',
            'tanggal_selesai' => 'required|date_format:Y-m-d\TH:i|after_or_equal:tanggal_mulai',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        if($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('promos', 'public');
        }

        Promo::create($data);
        return redirect(session('admin_last_page', route('promos.index')))->with('success', 'Berhasil');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promo $promo)
    {
        $tenants = Tenant::all();
        return view('admin.promos.form', compact('promo', 'tenants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promo $promo)
    {
        $data = $request->validate([
            'id_tenant' => 'required|exists:tenants,id_tenant',
            'nama_promo' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date_format:Y-m-d\TH:i',
            'tanggal_selesai' => 'required|date_format:Y-m-d\TH:i|after_or_equal:tanggal_mulai',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        if($request->hasFile('gambar')) {
            if($promo->gambar) Storage::disk('public')->delete($promo->gambar);
            $data['gambar'] = $request->file('gambar')->store('promos', 'public');
        }

        $promo->update($data);
        return redirect(session('admin_last_page', route('promos.index')))->with('success', 'Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promo $promo)
    {
        if($promo->gambar) Storage::disk('public')->delete($promo->gambar);
        $promo->delete();
        return redirect(session('admin_last_page', route('promos.index')))->with('success', 'Berhasil');
    }
}
