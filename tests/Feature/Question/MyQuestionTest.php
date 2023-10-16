<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to list all question created by me', function () {

    $wrongUser = User::factory()->create();

    $wrongQuestion = Question::factory()->count(10)->for($wrongUser, 'createdBy')->create();

    $user = User::factory()->create();

    actingAs($user);

    $quesions = Question::factory()->for($user, 'createdBy')->count(10)->create();

    $response = get(route('question.index'));

    /** @var Question $q */
    foreach ($quesions as $q) {
        $response->assertSee($q->question);
    }

    /** @var Question $q */
    foreach ($wrongQuestion as $q) {
        $response->assertDontSee($q->question);
    }
});
