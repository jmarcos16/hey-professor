<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able to create a new question bigger than 255 characters', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);
});

it('should checke if ends with question mark ?', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10),
    ]);

    $request->assertSessionHasErrors('question');
    assertDatabaseCount('questions', 0);
});

it('should have at last 10 characters', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    $request->assertSessionHasErrors('question');
    assertDatabaseCount('questions', 0);
});

it('should create as a draft all the time', function () {
    $user = User::factory()->create();
    actingAs($user);

    $user = User::factory()->create();
    actingAs($user);

    post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260) . '?',
        'draft'    => true,
    ]);
});

it('should make sure that only authenticated users can create a question', function () {
    post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ])->assertRedirect(route('login'));
});
