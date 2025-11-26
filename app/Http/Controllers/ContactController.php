<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Profile;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['admin_last_page' => url()->current()]);

        $contacts = Contact::with('profile')->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profiles = Profile::all();
        return view('admin.contacts.form', compact('profiles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_profile' => 'required|exists:profiles,id_profile',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'email' => 'nullable|email',
            'maps_embed' => 'nullable|string',
        ]);

        Contact::create($request->all());
        return redirect(session('admin_last_page', route('contacts.index')))->with('success', 'Berhasil');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $profiles = Profile::all();
        return view('admin.contacts.form', compact('contact', 'profiles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'id_profile' => 'required|exists:profiles,id_profile',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'email' => 'nullable|email',
            'maps_embed' => 'nullable|string',
        ]);

        $contact->update($request->all());
        return redirect(session('admin_last_page', route('contacts.index')))->with('success', 'Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect(session('admin_last_page', route('contacts.index')))->with('success', 'Berhasil');
    }
}
