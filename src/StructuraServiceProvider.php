<?php

declare(strict_types=1);

namespace StructuraPhp\StructuraLaravel;

use Illuminate\Support\ServiceProvider;
use StructuraPhp\StructuraLaravel\Commands\StructuraInitCommand;
use StructuraPhp\StructuraLaravel\Commands\StructuraRunCommand;

final class StructuraServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                StructuraInitCommand::class,
                StructuraRunCommand::class,
            ]);

            $this->publishes(
                [
                    dirname(__DIR__) . '/config/structura.php' => config_path('structura.php'),
                ],
                'structura-config',
            );
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/structura.php',
            'structura',
        );
    }
}
