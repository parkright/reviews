<?php

namespace Parkright\Reviews\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Parkright\Reviews\Models\Review;
use Parkright\Reviews\Tests\Models\User;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();
        return [
            'user_id' => $user->id,
            'author' => $user->name,
            'title' => $this->faker->text,
            'body' => $this->faker->text,
            'rating' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'model_id' => 1,
            'model_type' => 'App/ParkRight/Product',
            'ip_address' => $this->faker->ipv4
        ];
    }

}
