<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Genre;

use Illuminate\Database\Eloquent\Factories\Factory;

class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->word(),
            'slug'=>$this->faker->slug(),
            'edition'=>$this->faker->word(),
            'user_id'=> User::factory(),
            'genre_id'=> Genre::factory()

        ];
    }
}