<?php

namespace Modules\Campaign\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $campaigns = $model->latest()->paginate(5);

        // If accessed via API
        if($request->wantsJson()) {
            return response()->json($campaigns, Response::HTTP_OK); 
        }

        return Inertia::render('Campaign/Views/List', compact('campaigns'));
    }
}
