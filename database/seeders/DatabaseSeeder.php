<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Genre;
use App\Models\Books;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Genre::truncate();
        Books::truncate();


        $user = User::factory()->create();

        $genre1 = Genre::create(['name' => 'Roman', 'slug' => 'roman']);
        $genre2 = Genre::create(['name' => 'Klasik', 'slug' => 'klasik']);

        Books::factory(2)->create([
            'user_id' => $user->id,
            'genre_id' => $genre1->id
        ]);
        Books::factory(2)->create([
            'user_id' => $user->id,
            'genre_id' => $genre2->id
        ]);

    }
}
