<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
      'id',
      'slug',
      'original_name',
      'image',
      'preparation_time',
      'price_range',
      'is_public',
    ];

    protected $appends = ['average_rating'];

    protected $casts = [
        'preparation_time' => 'integer',
        'price_range' => 'integer',
        'is_public' => 'boolean',
    ];

    use HasFactory;

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }

    public function ratings()
    {
      return $this->hasMany(Rating::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->ratings()->average('rating');
    }
}
