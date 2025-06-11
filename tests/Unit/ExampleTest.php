<?php

declare(strict_types=1);

test('unit test example', function (): void {
    $i = 1 + 1;

    expect($i)->toBeNumeric();
    expect($i)->toBe(2);
});
