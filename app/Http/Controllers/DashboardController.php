<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('dashboard', [
            'questions' => Question::query()
                ->withSum('votes', 'like')
                ->withSum('votes', 'unlike')
                ->latest()
                ->get(),
        ]);
    }
}
