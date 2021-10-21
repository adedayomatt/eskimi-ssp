<?php
use Illuminate\Support\Facades\Route;

/**
 * Routes for the web are registered here
 */
Route::middleware('auth')->group(function(){
   // All campaigns
   Route::get('/', \Modules\Campaign\Controllers\CampaignList::class)->name('list');

   // Update a campaign
   Route::put('{campaign}', \Modules\Campaign\Controllers\CampaignUpdate::class)->name('update');

   // Store a new campaign
   Route::post('/store', \Modules\Campaign\Controllers\CampaignStore::class)->name('store');
   
});