<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profile;
use App\Models\Contact;
use App\Models\Floor;
use App\Models\Category;
use App\Models\Tenant;
use App\Models\Promo;
use App\Models\Facility;
use App\Models\Event;


class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profile::all();
        $contacts = Contact::all();
        $floors = Floor::all();
        $categories = Category::all();
        $tenants = Tenant::all();
        $promos = Promo::all();
        $facilities = Facility::all();
        $events = Event::all();

        return view('frontend.index', compact('profiles', 'contacts', 'floors', 'categories', 'tenants', 'promos', 'facilities', 'events'));
    }

    public function tenantList(Request $request) {
        $category = $request->category;

        $floor = $request->floor;

        $categories = Category::all();
        $floors = Floor::all();

        $tenants = Tenant::query();

        if($category) {
            $tenants->where('id_category', $category);
        }

        if($floor) {
            $tenants->where('id_floor', $floor);
        }

        $tenants = $tenants->get();

        return view('frontend.tenant-list', compact('tenants', 'categories', 'floors', 'category', 'floor'));
    }

    public function ajaxTenants(Request $request) {
        $category = $request->category;
        $floor = $request->floor;

        $query = Tenant::query()->with(['category', 'floor']);

        if($category && $category !== 'all') {
            $query->where('id_category', $category);
        } 

        if($floor && $floor !== 'all') {
            $query->where('id_floor', $floor);
        }

        $tenants = $query->get();

        return response()->json(['tenants' => $tenants]);
    }

    public function promoList(Request $request) {
        $tenant = $request->tenant;

        $tenants = Tenant::all();

        $promos = Promo::query();

        if($tenant) {
            $promos->where('id_tenant', $tenant);
        }

        $promos = $promos->get();

        return view('frontend.promo-list', compact('promos', 'tenants', 'tenant'));
    }

    public function ajaxPromos(Request $request) {
        $tenant = $request->tenant;

        $query = Promo::query()->with(['tenant']);

        if($tenant && $tenant !== 'all') {
            $query->where('id_tenant', $tenant);
        }

        $promos = $query->get();

        return response()->json(['promos' => $promos]);
    }

    public function eventList(Request $request) {
        $floor = $request->floor;

        $floors = Floor::all();

        $events = Event::query();

        if($floor) {
            $events->where('id_floor', $floor);
        }

        $events = $events->get();

        return view('frontend.event-list', compact('events', 'floors', 'floor'));
    }

    public function ajaxEvents(Request $request) {
        $floor = $request->floor;

        $query = Event::query()->with(['floor']);

        if($floor && $floor !== 'all') {
            $query->where('id_floor', $floor);
        }

        $floors = $query->get();

        return response()->json(['events' => $events]);
    }
}
