<?php

namespace App\Http\Controllers\Api;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class RecipeController extends Controller
{
    public function index()
    {
      return Recipe::with('comments')->get()->take(21);
    }

}
