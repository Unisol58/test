<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\StoreRatingRequest;

class RatingController extends Controller
{

  public function index()
  {
    return Rating::all();
  }
  /**
   * Store comments on recipes
   * @param  StoreCommentRequest $request Validate request
   * @return object                       Newly created comment
   */
  public function store(StoreRatingRequest $request)
  {
    return auth()->user()->ratings()->updateOrCreate([
        'user_id' => auth()->user()->id,
        'recipe_id' => $request->validated()['recipe_id']
      ], $request->validated());
  }

  /**
   * Get recipe rating for user id
   * @param  User   $user   User Collection
   * @param  Recipe $recipe Recipe Collection
   * @return mixed          Returns object if found, else 404
   */
  public function getUserRating(User $user, Recipe $recipe)
  {
      $rating = $user->ratings()->where('recipe_id', $recipe->id)->get();
      return $rating->isNotEmpty() ? $rating : response()->json(['message' => 'Not Found!'], 404);
  }
}
