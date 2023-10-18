<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to edit a question', function () {

    $user     = User::factory()->create();
    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create();

    actingAs($user);

    $response = get(route('question.edit', $question))
        ->assertSuccessful();
});

it('should be able return a view', function () {
    $user     = User::factory()->create();
    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create();

    actingAs($user);

    $response = get(route('question.edit', $question))
        ->assertViewIs('question.edit');
});

it('should make sure that only question with status DRAFT can be edited', function () {
    $user             = User::factory()->create();
    $questionNotDraft = Question::factory()
        ->for($user, 'createdBy')
        ->create([
            'draft' => false,
        ]);

    $questionDraft = Question::factory()
        ->for($user, 'createdBy')
        ->create([
            'draft' => true,
        ]);

    actingAs($user);

    $response = get(route('question.edit', $questionNotDraft))
        ->assertForbidden();

    $response = get(route('question.edit', $questionDraft))->assertSuccessful();
});
