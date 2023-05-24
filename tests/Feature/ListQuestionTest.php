<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should list all the questions', function () {
    $user = User::factory()->create();
    actingAs($user);

    $quesions = Question::factory()->count(5)->create();

    $response = get(route('dashboard'));

    /** @var Question $q */
    foreach ($quesions as $q) {
        $response->assertSee($q->question);
    }
});
