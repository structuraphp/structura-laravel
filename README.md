# Structura Laravel Extension

<p align="center">
  <img src="../docs/structura-logo.png" alt="Structura Logo" width="400">
</p>

Laravel extension for [Structura](https://github.com/structuraphp/structura) — Install pre-configured architecture test
stubs for your Laravel application.

## Installation

```shell
composer require --dev structuraphp/structura-laravel
```

The service provider is auto-discovered by Laravel.

## Usage

### Initialize architecture tests


```shell
php artisan structura:init
```

This command will:

1. Create the `structura.php` config file at the root of your project (if it doesn't exist)
2. Prompt a **multi-select** to choose which architecture test stubs to install
3. Generate the selected test files in `tests/Architecture/`

### Run Structura commands

The `structura` command is a pass-through to the native StructuraPHP CLI:

```shell
# Run architecture analysis (default)
php artisan structura

# Explicit analyze
php artisan structura analyze

# With options
php artisan structura analyze --test-suite=laravel --stop-on-failure

# Other commands
php artisan structura init
php artisan structura make:test
```

## Configuration

Publish the config file to customize paths and namespaces:

```shell
php artisan vendor:publish --tag=structura-config
```

This creates `config/structura.php`:

```php
return [
    // Output directory for generated test files
    'output_dir' => 'tests/Architecture',

    // Namespace for generated test classes
    'output_namespace' => 'Tests\\Architecture',

    // Source paths per category
    'paths' => [
        'controller'   => 'app/Http/Controllers',
        'dto'          => 'app/DataTransferObjects',
        'event'        => 'app/Events',
        'factory'      => 'database/factories',
        'form_request' => 'app/Http/Requests',
        'job'          => 'app/Jobs',
        'listener'     => 'app/Listeners',
        'mail'         => 'app/Mail',
        'middleware'    => 'app/Http/Middleware',
        'model'        => 'app/Models',
        'notification' => 'app/Notifications',
        'policy'       => 'app/Policies',
        'route'        => 'routes',
        'service'      => 'app/Services',
    ],
];
```

## Requirements

| Dependency | Version            |
|------------|--------------------|
| PHP        | >= 8.2             |
| Laravel    | 11.x / 12.x / 13.x |
| Structura  | >= 0.7             |
