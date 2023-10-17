<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Symfony\Component\HttpFoundation\Response;

class PublishController extends Controller
{
    public function __invoke(Question $question): \Illuminate\Http\RedirectResponse
    {

        $this->authorize('publish', $question);
        $question->update(['draft' => false]);

        return back();

    }
}
