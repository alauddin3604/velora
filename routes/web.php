<?php

declare(strict_types=1);

use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;

$basePath = dirname(__DIR__, 1);
$finder = new Finder;
$routePattern = '*/routes/web';

try {
    $directories = $finder->in($basePath)
        ->directories()
        ->name('web');

    foreach ($directories as $directory) {
        if (! Str::is($routePattern, $directory->getPathname())) {
            continue;
        }

        $routeFiles = (new Finder)->in($directory->getPathname())->files();

        foreach ($routeFiles as $routeFile) {
            if (! Str::contains($routeFile->getFilenameWithoutExtension(), '.web')) {
                continue;
            }

            include $routeFile->getPathname();
        }
    }
} catch (Exception $exception) {
    throw new RuntimeException('Failed to load web routes: '.$exception->getMessage(), $exception->getCode(), $exception);
}
