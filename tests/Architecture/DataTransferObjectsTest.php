<?php

declare(strict_types=1);

use Spatie\LaravelData\Data;

arch('data transfer objects must be final class')
    ->expect('App\DataTransferObjects')
    ->toBeFinal()
    ->toBeClass();

arch('data transfer objects must have constructor')
    ->expect('App\DataTransferObjects')
    ->toHaveConstructor();

arch('data transfer objects must have suffixed name with Data')
    ->expect('App\DataTransferObjects')
    ->toHaveSuffix('Data');

arch('data transfer objects must extend Spatie\LaravelData\Data')
    ->expect('App\DataTransferObjects')
    ->toExtend(Data::class);

arch('data transfer objects must not be abstract')
    ->expect('App\DataTransferObjects')
    ->not
    ->toBeAbstract();
