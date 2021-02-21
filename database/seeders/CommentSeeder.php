<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $recipes = Recipe::all();

      $recipes->each(function($recipe) {
        Comment::factory()->count(rand(1, 10))->create([
          'recipe_id' => $recipe->id,
        ]);
      });

    }
}
