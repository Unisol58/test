<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->random();
        return [
          'user_id' => $user->id,
          'name' => $user->name,
          'comment' => $this->faker->realText(rand(10, 300)),
          'created_at' => $this->faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now'),
        ];
    }
}
