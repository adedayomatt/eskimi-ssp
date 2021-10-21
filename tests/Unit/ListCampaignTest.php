<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use Inertia\Testing\Assert;
use Illuminate\Support\Facades\Route;
use Modules\Campaign\Models\Campaign;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListCampaignTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test for listing campaigns.
     *
     * @return void
     */
    public function test_campaigns_can_be_listed()
    {
        if (!Route::has('campaign.list')) {
            return $this->markTestSkipped('No route to list campaigns');
        }

        $this->actingAs($user = User::factory()->create());

        $campaign = Campaign::factory(5)->create();

        $response = $this->get(route('campaign.list'));

        /**
         * Asserting the Inertia response
         * 
         * https://inertiajs.com/testing
         * 
         */
        $response->assertInertia(function (Assert $page) {
            return $page
            ->component('Campaign/Views/List')
            ->has('campaigns')
            ->has('campaigns.data', 5);
        });
    }

    /**
     * Test for listing campaigns via API
     *
     * @return void
     */
    public function test_campaigns_can_be_listed_via_api()
    {
        if (!Route::has('api.campaign.list')) {
            return $this->markTestSkipped('No API route to list campaigns');
        }

        $user = User::factory()->create();

        $token = $user->createToken('Test', ['*'])->plainTextToken;

        $campaign = Campaign::factory(5)->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
            'Accept' => 'application/json'
        ])->json('GET', route('api.campaign.list'));

        $response
        ->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'total' => 5,
        ]);
    }
}
