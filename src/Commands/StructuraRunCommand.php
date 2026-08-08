<?php

declare(strict_types=1);

namespace StructuraPhp\StructuraLaravel\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

final class StructuraRunCommand extends Command
{
    /** @var string */
    protected $signature = 'structura
        {cmd=analyze : The structura command to run (analyze, init, make:test)}
        {args?* : Extra arguments/options forwarded as-is to structura (put them after --)}';

    /** @var string */
    protected $description = 'Run a Structura command (proxy to vendor/bin/structura)';

    public function handle(): int
    {
        $binary = $this->resolveBinary();

        if (!is_string($binary)) {
            $this->components->error('Structura binary not found. Run: composer require --dev structuraphp/structura');

            return self::FAILURE;
        }

        $arguments = $this->buildArguments($binary);

        $process = new Process(
            command: $arguments,
            cwd: base_path(),
            timeout: null,
        );

        if ($this->input->isInteractive() && Process::isTtySupported()) {
            $process->setTty(true);
        } elseif ($this->output->isDecorated() && Process::isPtySupported()) {
            $process->setPty(true);
        }

        $process->run(function (string $type, string $buffer): void {
            $this->output->write($buffer);
        });

        return $process->getExitCode() ?? self::FAILURE;
    }

    /**
     * @return list<string>
     */
    private function buildArguments(string $binary): array
    {
        $arguments = [$binary];

        /** @var string $cmd */
        $cmd = $this->argument('cmd');
        $arguments[] = $cmd;

        /** @var list<string> $extra */
        $extra = $this->argument('args');
        array_push($arguments, ...$extra);

        return $arguments;
    }

    private function resolveBinary(): ?string
    {
        $paths = [
            base_path('vendor/bin/structura'),
            base_path('bin/structura'),
        ];

        foreach ($paths as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }

        return null;
    }
}
