<?php

use App\Models\{Question, User};

use function Pest\Laravel\actingAs;

it('should be able to publish a question', function () {
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create();

    \Pest\Laravel\put(route('question.publish', $question))
        ->assertRedirect();

    $question->refresh();

    expect($question->draft)->toBe(false);
});
