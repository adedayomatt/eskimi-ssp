<?php

namespace Modules\Campaign\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Campaign\Models\Campaign;
use Symfony\Component\HttpFoundation\Response;
use Modules\Campaign\Requests\CampaignSaveRequest;

class CampaignStore extends Controller
{

    public function __construct()
    {
        $this->middleware('can:create,'.Campaign::class);
    }

    public function __invoke(CampaignSaveRequest $request, Campaign $model)
    {
         /** @var Campaign $campaign */
        $campaign = $model->query()->create($request->validated());

        // clear cache
        Cache::tags('campaign-pages')->flush();

        // If requested via API
        if($request->wantsJson()) {
            return response()->json($campaign, Response::HTTP_OK); 
        }

        return redirect()->back()->with('success', 'Campaign created');
    }
}
