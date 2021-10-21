<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Modules\Campaign\Models\Campaign;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCampaignTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;


    /**
     * Test for creating campaign
     *
     * @return void
     */
    public function test_campaign_can_be_created()
    {
        if (!Route::has('campaign.store')) {
            return $this->markTestSkipped('No route to store campaign');
        }

        $this->actingAs($user = User::factory()->create());

        $period = $this->faker->numberBetween(5, 30);
        $budget = $this->faker->randomFloat(2, 20, 100);
        
        $start = $this->faker->date();
        $end = (new Carbon($start))->add("{$period} days")->format('Y-m-d');

        $testData = [
            'name' => 'Test Campaign',
            'from' => $start,
            'to' => $end,
            'daily_budget' => $budget,
            'total_budget' => $budget * $period,
            'creatives' => [
                $this->faker->imageUrl(400, 300),
                $this->faker->imageUrl(400, 300)
            ]
        ];

        $response = $this->post(route('campaign.store'), $testData);

        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');

        $this->assertEquals($testData['name'], Campaign::first()->name);
    }

     /**
     * Test for creating campaign via API
     *
     * @return void
     */
    public function test_campaign_can_be_created_via_api()
    {
        if (!Route::has('api.campaign.store')) {
            return $this->markTestSkipped('No API route to store campaign');
        }

        $user = User::factory()->create();

        $token = $user->createToken('Test', ['*'])->plainTextToken;

        $period = $this->faker->numberBetween(5, 30);
        $budget = $this->faker->randomFloat(2, 20, 100);
        
        $start = $this->faker->date();
        $end = (new Carbon($start))->add("{$period} days")->format('Y-m-d');

        $testData = [
            'name' => 'Test Campaign',
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
        ])->json('POST', route('api.campaign.store'), $testData);

        $response
        ->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'name' => $testData['name']
        ]);
    }
}
