<?php

namespace Modules\Campaign\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Campaign\Models\Campaign;
use Symfony\Component\HttpFoundation\Response;

class CampaignShow extends Controller
{

    public function __construct()
    {

    }

    public function __invoke(Request $request, Campaign $campaign)
    {     
        // If requested via API
        if($request->wantsJson()) {
            return response()->json($campaign, Response::HTTP_OK); 
        }
        return Inertia::render('Campaign/Views/Show', compact('campaign'));
    }
}
