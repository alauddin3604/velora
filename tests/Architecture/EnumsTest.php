<?php

declare(strict_types=1);

arch('enums must be enums', function (): void {
    expect('App\Enums')
        ->toBeEnum();
});
