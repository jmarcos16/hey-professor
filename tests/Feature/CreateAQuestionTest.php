<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('should be able to create a new question bigger than 255 characters', function () {
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);
});

// it('should checke if ends with question mark ?', function () {
//     $request = post(route('question.store'), [
//         'question' => str_repeat('*', 10),
//     ]);

//     $request->assertSessionHasErrors('question');
//     assertDatabaseCount('questions', 0);
// });

it('should have at last 10 characters', function () {
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    $request->assertSessionHasErrors('question');
    assertDatabaseCount('questions', 0);
});
