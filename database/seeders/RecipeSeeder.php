<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $response = Http::get('https://api.fitlap.ee/v2/recipes/public');

      $recipes = json_decode($response->body());

      foreach ($recipes->data as $recipie) {
        DB::table('recipes')->insert((array) $recipie);
      }

    }
}
