<?php

namespace Database\Factories;

use Carbon\Carbon;
use Modules\Campaign\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Campaign::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $period = $this->faker->numberBetween(5, 30);
        $budget = $this->faker->randomFloat(2, 20, 100);
        
        $start = $this->faker->date();
        $end = (new Carbon($start))->add("{$period} days")->format('Y-m-d');

        return [
            'name' => $this->faker->sentence(2),
            'from' => $start,
            'to' => $end,
            'daily_budget' => $budget,
            'total_budget' => $budget * $period,
            'creatives' => [
                $this->faker->imageUrl(400, 300),
                $this->faker->imageUrl(400, 300)
            ]
        ];
    }
}
