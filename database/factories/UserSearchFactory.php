<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserSearch>
 */
class UserSearchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'keyword'=>$this->faker->city(),
            'count' =>  rand(1000,100000),
            'updated_at'    =>  $this->faker->date()
        ];
    }
}
