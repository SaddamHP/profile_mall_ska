<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Category;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['admin_last_page' => url()->current()]);

        $tenants = Tenant::with(['category', 'floor'])->get();
        return view('admin.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $floors = Floor::all();
        return view('admin.tenants.form', compact('categories', 'floors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_category' => 'required|exists:categories,id_category',
            'id_floor' => 'required|exists:floors,id_floor',
            'nama_tenant' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|max:2048',
        ]);

        $data = $request->all();
        if($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('tenants', 'public');
        }

        Tenant::create($data);
        return redirect(session('admin_last_page', route('tenants.index')))->with('success', 'Berhasil');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        $categories = Category::all();
        $floors = Floor::all();
        return view('admin.tenants.form', compact('tenant', 'categories', 'floors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        $data = $request->validate([
            'id_category' => 'required|exists:categories,id_category',
            'id_floor' => 'required|exists:floors,id_floor',
            'nama_tenant' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
            'kontak' => 'nullable|string|max:255'
        ]);

        $data = $request->all();
        if($request->hasFile('gambar')) {
            if($tenant->gambar) Storage::disk('public')->delete($tenant->gambar);
            $data['gambar'] = $request->file('gambar')->store('tenants', 'public');
        }

        $tenant->update($data);
        return redirect(session('admin_last_page', route('tenants.index')))->with('success', 'Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        if($tenant->gambar) Storage::disk('public')->delete($tenant->gambar);
        $tenant->delete();
        return redirect(session('admin_last_page', route('tenants.index')))->with('success', 'Berhasil');
    }
}
