<?php

use function Pest\Laravel\{actingAs, assertDatabaseHas, post};

it('should be able to vote up a question', function () {
    $user     = \App\Models\User::factory()->create();
    $question = \App\Models\Question::factory()->create();

    actingAs($user);

    post(route('question.like', $question))
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

    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));

    expect($user->votes()->count())->toBe(1);
});

it('should be able unlike to vote up a question', function () {
    $user     = \App\Models\User::factory()->create();
    $question = \App\Models\Question::factory()->create();

    actingAs($user);

    post(route('question.unlike', $question))
        ->assertRedirect();

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like'        => 0,
        'unlike'      => 1,
        'user_id'     => $user->id,
    ]);
});

it('should not be able to unlike more than 1 time', function () {
    $user     = \App\Models\User::factory()->create();
    $question = \App\Models\Question::factory()->create();

    actingAs($user);

    post(route('question.unlike', $question));
    post(route('question.unlike', $question));
    post(route('question.unlike', $question));
    post(route('question.unlike', $question));

    expect($user->votes()->count())->toBe(1);
});
