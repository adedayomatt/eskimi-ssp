<?php
use Illuminate\Support\Facades\Route;

/**
 * Routes for the api are registered here
 */
Route::middleware('auth:sanctum')->group(function(){

    // List all advertising campaigns and their info
   Route::get('/', \Modules\Campaign\Controllers\CampaignList::class)->name('list');

    //  Store new advertising campaign  
   Route::post('/store', \Modules\Campaign\Controllers\CampaignStore::class)->name('store');

    // Retrieve a single campaign
    Route::get('/{campaign}', \Modules\Campaign\Controllers\CampaignShow::class)->name('show');

});