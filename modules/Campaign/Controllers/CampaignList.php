<?php

namespace Modules\Campaign\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Campaign\Models\Campaign;
use Symfony\Component\HttpFoundation\Response;

class CampaignList extends Controller
{

    public function __construct()
    {
        $this->middleware('can:read,'.Campaign::class);
    }

    public function __invoke(Request $request, Campaign $model)
    {
        // check cache first for the request page
        $campaigns = Cache::tags('campaign-pages')
                    ->remember($request->get('page', 1), 33600, function() use ($model) {
                        return $model->latest()->paginate(10);
                    });

        // If requested via API
        if($request->wantsJson()) {
            return response()->json($campaigns, Response::HTTP_OK); 
        }

        return Inertia::render('Campaign/Views/List', compact('campaigns'));
    }
}
