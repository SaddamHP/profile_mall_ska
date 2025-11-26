<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['admin_last_page' => url()->current()]);

        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_category' => 'required|string|max:100',
            'deskripsi' => 'nullable|string'
        ]);

        Category::create($request->all());
        return redirect(session('admin_last_page', route('categories.index')))->with('success', 'Berhasil');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama_category' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        $category->update($request->all());
        return redirect(session('admin_last_page', route('categories.index')))->with('success', 'Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect(session('admin_last_page', route('categories.index')))->with('success', 'Berhasil');
    }
}
