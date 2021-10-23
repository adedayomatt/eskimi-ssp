<?php

namespace Modules\Campaign\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampaignPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /*
    * Determine if user can list campaigns
    *
    * @param  \App\Models\User  $user
    * @return bool
    */

    public function read(User $user): bool
    {
        return request()->wantsJson() 
        ? request()->user()->tokenCan('read')
        : true;
    }

    /*
    * Determine if user can create campaign
    *
    * @param  \App\Models\User  $user
    * @return bool
    */

    public function create(User $user): bool
    {
        // if the request is from API, check that the access token has the create permission
        return request()->wantsJson() 
        ? request()->user()->tokenCan('create')
        : true;
    }
}
