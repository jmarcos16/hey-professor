<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Vote;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Question $question) : \Illuminate\Http\RedirectResponse
    {
        Vote::query()->create([
            'question_id' => $question->id,
            'like'        => 1,
            'unlike'      => 0,
            'user_id'     => auth()->id(),
        ]);

        return back();
    }
}
