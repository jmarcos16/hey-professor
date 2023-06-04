<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;

class UnlikeController extends Controller
{
    public function __invoke(\App\Models\Question $question): \Illuminate\Http\RedirectResponse
    {
        user()->unlike($question);

        return back();
    }
}
