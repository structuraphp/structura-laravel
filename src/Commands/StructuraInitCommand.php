<?php

declare(strict_types=1);

namespace StructuraPhp\StructuraLaravel\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use StructuraPhp\StructuraLaravel\Enums\StubCategory;

use function Laravel\Prompts\info;
use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\warning;

final class StructuraInitCommand extends Command
{
    /** @var string */
    protected $signature = 'structura:init';

    /** @var string */
    protected $description = 'Initialize Structura architecture tests with Laravel stubs';

    public function handle(): int
    {
        $this->components->info('🏗️  Structura - Laravel Architecture Tests');

        $this->ensureStructuraConfigExists();

        $categories = multiselect(
            label: 'Which architecture tests do you want to install?',
            options: $this->getStubCategory(),
            default: $this->getDefaultCategories(),
            required: true,
        );

        $outputDir = $this->getOutputDir();

        File::ensureDirectoryExists(base_path($outputDir));

        $installed = [];

        foreach ($categories as $value) {
            $category = StubCategory::from($value);
            $outputPath = base_path($outputDir . '/' . $category->outputFilename());

            if (File::exists($outputPath)) {
                warning(
                    sprintf(
                        '⏩ Skipped %s — %s already exists.',
                        $category->label(),
                        $category->outputFilename(),
                    ),
                );

                continue;
            }

            $stubPath = $this->getStubPath($category);
            $content = $this->buildStub($stubPath, $category);

            File::put($outputPath, $content);
            $installed[] = $category->label();
        }

        if ($installed === []) {
            warning('No new test files were installed.');

            return self::SUCCESS;
        }

        info('✅ Installed architecture tests:');

        foreach ($installed as $name) {
            $this->components->task($name);
        }

        $this->newLine();
        $this->components->info("Run 'vendor/bin/structura analyze' to execute your architecture tests.");

        return self::SUCCESS;
    }

    /**
     * @return array<string, string>
     */
    private function getStubCategory(): array
    {
        $options = [];

        foreach (StubCategory::cases() as $category) {
            $options[$category->value] = $category->label();
        }

        return $options;
    }

    /**
     * @return list<string>
     */
    private function getDefaultCategories(): array
    {
        $defaults = [];

        foreach (StubCategory::cases() as $category) {
            $path = Config::string('structura.paths.' . $category->value, 'app');

            if (File::isDirectory(base_path($path))) {
                $defaults[] = $category->value;
            }
        }

        return $defaults;
    }

    private function getStubPath(StubCategory $category): string
    {
        return dirname(__DIR__) . '/Stubs/' . $category->stubFilename();
    }

    private function buildStub(string $stubPath, StubCategory $category): string
    {
        $namespace = Config::string('structura.output_namespace', 'Tests\Architecture');
        $sourcePath = Config::string('structura.paths.' . $category->value, 'app');

        $content = File::get($stubPath);

        return str_replace(
            ['{{ namespace }}', '{{ path }}'],
            [$namespace, $sourcePath],
            $content,
        );
    }

    private function getOutputDir(): string
    {
        return Config::string('structura.output_dir', 'tests/Architecture');
    }

    private function ensureStructuraConfigExists(): void
    {
        $configPath = base_path('structura.php');

        if (File::exists($configPath)) {
            return;
        }

        $namespace = Config::string('structura.output_namespace', 'Tests\Architecture');
        $outputDir = Config::string('structura.output_dir', 'tests/Architecture');

        $content = <<<PHP
        <?php

        declare(strict_types=1);

        use StructuraPhp\\Structura\\Contracts\\StructuraConfigInterface;

        return static function (StructuraConfigInterface \$config): void {
            \$config->addTestSuite('{$outputDir}', 'laravel');
            \$config->archiRootNamespace(
                '{$namespace}',
                '{$outputDir}',
            );
        };

        PHP;

        File::put($configPath, $content);
        $this->components->task('Created structura.php config');
    }
}
