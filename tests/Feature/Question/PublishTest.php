<?php

use App\Models\{Question, User};

use function Pest\Laravel\actingAs;

it('should be able to publish a question', function () {
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create();

    \Pest\Laravel\put(route('question.publish', $question))
        ->assertRedirect();

    $question->refresh();

    expect($question->draft)->toBe(false);
});

it('should make sure that only the person who has created the question can publish the question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question  = Question::factory()->create([
        'draft'      => true,
        'created_by' => $rightUser->id,
    ]);

    actingAs($wrongUser);

    \Pest\Laravel\put(route('question.publish', $question))
        ->assertForbidden();

    actingAs($rightUser);

    \Pest\Laravel\put(route('question.publish', $question))
        ->assertRedirect();
});
