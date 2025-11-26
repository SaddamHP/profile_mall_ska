<?php

use App\Http\Controllers\{
    ProfileController,
    ContactController,
    FloorController,
    CategoryController,
    TenantController,
    PromoController,
    FacilityController,
    EventController,
    FrontendController
};

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/tenant-list', [FrontendController::class, 'tenantList'])->name('tenant.list');
Route::get('/promo-list', [FrontendController::class, 'promoList'])->name('promo.list');
Route::get('/event-list', [FrontendController::class, 'eventList'])->name('event.list');

Route::get('/ajax/promos', [FrontendController::class, 'ajaxPromos'])->name('ajax.promos');
Route::get('/ajax/tenants', [FrontendController::class, 'ajaxTenants'])->name('ajax.tenants');
Route::get('ajax/events', [FrontendController::class, 'ajaxEvents'])->name('ajax.events');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', function() {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function() {
    Route::resource('profiles', ProfileController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('floors', FloorController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tenants', TenantController::class);
    Route::resource('promos', PromoController::class);
    Route::resource('facilities', FacilityController::class);
    Route::resource('events', EventController::class);
});

require __DIR__.'/auth.php';
