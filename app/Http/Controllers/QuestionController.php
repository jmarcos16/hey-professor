<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {
        request()->validate([
            'question' => ['required', 'min:10', 'ends_with:?'],
        ]);

        user()->questions()->create([
            'question' => request('question'),
            'draft'    => true,
        ]);

        return to_route('dashboard');
    }
}
