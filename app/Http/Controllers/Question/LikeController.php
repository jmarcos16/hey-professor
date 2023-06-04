<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Question $question): \Illuminate\Http\RedirectResponse
    {
        user()->like($question);

        return back();
    }
}
