<?php

function user(): \App\Models\User|null
{
    if(auth()->check()) {
        return auth()->user(); /* @phpstan-ignore-line */
    }

    return null;
}
