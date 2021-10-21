<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Modules\Campaign\Models\Campaign;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateCampaignTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * Test for updating campaign.
     *
     * @return void
     */
    public function test_campaign_can_be_updated()
    {
        if (!Route::has('campaign.update')) {
            return $this->markTestSkipped('No route to update campaign');
        }

        $this->actingAs($user = User::factory()->create());

        $campaign = Campaign::factory()->create();

        $period = $this->faker->numberBetween(5, 30);
        $budget = $this->faker->randomFloat(2, 20, 100);
        
        $start = $this->faker->date();
        $end = (new Carbon($start))->add("{$period} days")->format('Y-m-d');

        $testData = [
            'name' => 'Updated Test Campaign',
            'from' => $start,
            'to' => $end,
            'daily_budget' => $budget,
            'total_budget' => $budget * $period,
            'creatives' => [
                $this->faker->imageUrl(400, 300),
                $this->faker->imageUrl(400, 300)
            ]
        ];

        $response = $this->put(route('campaign.update', ['campaign' => $campaign->getKey()]), $testData);

        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');

        $this->assertEquals($testData['name'], $campaign->fresh()->name);
    }

    /**
     * Test for updating campaign via API
     *
     * @return void
     */
    public function test_campaign_can_be_updated_via_api()
    {
        if (!Route::has('api.campaign.update')) {
            return $this->markTestSkipped('No API route to update campaign');
        }

        $user = User::factory()->create();
        $token = $user->createToken('Test', ['*'])->plainTextToken;

        $campaign = Campaign::factory()->create();

        $period = $this->faker->numberBetween(5, 30);
        $budget = $this->faker->randomFloat(2, 20, 100);
        
        $start = $this->faker->date();
        $end = (new Carbon($start))->add("{$period} days")->format('Y-m-d');

        $testData = [
            'name' => 'Updated Test Campaign',
            'from' => $start,
            'to' => $end,
            'daily_budget' => $budget,
            'total_budget' => $budget * $period,
            'creatives' => [
                $this->faker->imageUrl(400, 300),
                $this->faker->imageUrl(400, 300)
            ]
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
            'Accept' => 'application/json'
        ])->json('PUT', route('api.campaign.update', ['campaign' => $campaign->getKey()]), $testData);

        $response
        ->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'name' => $testData['name']
        ]);
    }
}
