<?php

declare(strict_types=1);

arch('actions must be class')
    ->expect('App\Actions')
    ->toBeClass();

arch('action must be final and readonly')
    ->expect('App\Actions')
    ->toBeFinal()
    ->toBeReadOnly();
