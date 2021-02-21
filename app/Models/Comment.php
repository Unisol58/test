<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function Recipe()
    {
      return $this->belongsTo(Recepie::class);
    }


    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
