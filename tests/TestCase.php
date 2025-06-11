<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Override;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * {@inheritDoc}
     */
    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }
}
