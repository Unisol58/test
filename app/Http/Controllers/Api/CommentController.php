<?php

namespace App\Http\Controllers\Api;

use App\Models\Recipe;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
  /**
   * Store comments on recipes
   * @param  StoreCommentRequest $request Validate request
   * @return object                       Newly created comment
   */
  public function store(StoreCommentRequest $request)
  {
    return auth()->user()->comments()->create($request->validated());
  }
}
