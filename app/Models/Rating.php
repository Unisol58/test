<?php

namespace App\Models;

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['rating', 'recipe_id'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function recipe()
    {
      return $this->belongsTo(Recipe::class);
    }
}
