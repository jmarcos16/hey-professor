<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    public function index(): View
    {
        return view('question.index', [
            'questions' => user()->questions, /* @phpstan-ignore-line */
        ]);
    }

    public function store(): RedirectResponse
    {
        request()->validate([
            'question' => ['required', 'min:10', 'ends_with:?'],
        ]);

        user()->questions()->create([
            'question' => request('question'),
            'draft'    => true,
        ]);

        return back();
    }

    public function edit(Question $question): View
    {
        $this->authorize('update', $question);

        return view('question.edit', [
            'question' => $question,
        ]);
    }

    public function destroy(Question $question): RedirectResponse
    {
        $this->authorize('destroy', $question);

        $question->delete();

        return back();
    }
}
