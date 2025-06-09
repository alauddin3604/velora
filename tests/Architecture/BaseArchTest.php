<?php

declare(strict_types=1);

arch()->preset()->laravel();

arch('classes must have documented methods')
    ->expect('App')
    ->toHaveMethodsDocumented();
