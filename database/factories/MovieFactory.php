<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genre = $this->faker->randomElement([
            'Action', 'Comedy', 'Children', 'Crime', 'Documentary',
            'Drama', 'Horror', 'Fantasy', 'Mystery'
        ]);

        return [
            "title"      => $this->faker->sentence(3),
            "genre"      => $genre,
            "production" => $this->faker->company(),
            "country"    => $this->faker->country(),
            "duration"   => $this->faker->numberBetween(30, 240),
            "year"       => $this->faker->dateTime(),
        ];
    }
}
