<?php

use function Pest\Laravel\{actingAs, assertDatabaseHas, post};

it('should be able to vote up a question', function () {
    $user     = \App\Models\User::factory()->create();
    $question = \App\Models\Question::factory()->create();

    actingAs($user);

    post(route('question.vote', $question))
    ->assertRedirect();

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like'        => 1,
        'unlike'      => 0,
        'user_id'     => $user->id,
    ]);
});

it('should not be able to like more than 1 time', function () {
    $user     = \App\Models\User::factory()->create();
    $question = \App\Models\Question::factory()->create();

    actingAs($user);

    post(route('question.vote', $question));
    post(route('question.vote', $question));
    post(route('question.vote', $question));
    post(route('question.vote', $question));

    expect($user->votes()->count())->toBe(1);
});