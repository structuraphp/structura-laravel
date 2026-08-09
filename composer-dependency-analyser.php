<?php

declare(strict_types=1);

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;

$config = new Configuration();

return $config
    ->setFileExtensions(['php', 'stub'])
    ->ignoreUnknownClasses(['App\Http\Controllers\Controller']);
