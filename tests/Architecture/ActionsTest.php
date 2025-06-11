<?php

declare(strict_types=1);

use App\Actions\Action;

arch('actions must be class', function (): void {
    expect('App\Actions')->toBeClass();
});

arch('base action must be abstract and readonly', function (): void {
    expect(Action::class)
        ->toBeAbstract()
        ->toBeReadOnly();
});

arch('base action must not have public methods', function (): void {
    expect(Action::class)
        ->not
        ->toHavePublicMethods();
});

arch('all actions must extend base action', function (): void {
    expect('App\Actions')
        ->toExtend(Action::class)
        ->ignoring([
            Action::class,
        ]);
});

arch('action must be final', function (): void {
    expect('App\Actions')
        ->toBeFinal()
        ->ignoring([
            Action::class,
        ]);
});

arch('actions must not be abstract', function (): void {
    expect('App\Actions')
        ->not
        ->toBeAbstract()
        ->ignoring([
            Action::class,
        ]);
});

arch('actions must have suffixed name with Action', function (): void {
    expect('App\Actions')
        ->toHaveSuffix('Action');
});

arch('actions must not have public methods besides run()', function (): void {
    expect('App\Actions')
        ->not
        ->toHavePublicMethodsBesides(['run']);
});
