<?php

namespace Modules\Campaign\Controllers;

use App\Http\Controllers\Controller;
use Modules\Campaign\Models\Campaign;
use Symfony\Component\HttpFoundation\Response;
use Modules\Campaign\Requests\CampaignSaveRequest;

class CampaignStore extends Controller
{

    public function __construct()
    {

    }

    public function __invoke(CampaignSaveRequest $request, Campaign $model)
    {
         /** @var Campaign $campaign */
        $campaign = $model->query()->create($request->validated());

        // If accessed via API
        if($request->wantsJson()) {
            return response()->json($campaign, Response::HTTP_OK); 
        }

        return redirect()->back()->with('success', 'Campaign created');
    }
}
