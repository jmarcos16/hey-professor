<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {
        $attributes = request()->validate([
            'question' => ['required', 'min:10', 'ends_with:?'],
        ]);

        Question::query()->create([
            'question' => request('question'),
            'draft'    => true,
        ]);

        return to_route('dashboard');
    }
}
