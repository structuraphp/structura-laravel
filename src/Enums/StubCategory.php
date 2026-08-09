<?php

declare(strict_types=1);

namespace StructuraPhp\StructuraLaravel\Enums;

enum StubCategory: string
{
    case Command = 'command';
    case Component = 'component';
    case Controller = 'controller';
    case Dto = 'dto';
    case Event = 'event';
    case Factory = 'factory';
    case FormRequest = 'form_request';
    case Job = 'job';
    case Listener = 'listener';
    case Mail = 'mail';
    case Middleware = 'middleware';
    case Migration = 'migration';
    case Model = 'model';
    case Notification = 'notification';
    case Policy = 'policy';
    case Resource = 'resource';
    case Route = 'route';
    case Rule = 'rule';
    case Seeder = 'seeder';
    case Service = 'service';

    public function label(): string
    {
        return match ($this) {
            self::Command => 'Commands',
            self::Component => 'View Components',
            self::Controller => 'Controllers',
            self::Dto => 'DTOs (Data Transfer Objects)',
            self::Event => 'Events',
            self::Factory => 'Factories',
            self::FormRequest => 'Form Requests',
            self::Job => 'Jobs',
            self::Listener => 'Listeners',
            self::Mail => 'Mailables',
            self::Middleware => 'Middlewares',
            self::Migration => 'Migrations',
            self::Model => 'Models',
            self::Notification => 'Notifications',
            self::Policy => 'Policies',
            self::Resource => 'Resources',
            self::Route => 'Routes',
            self::Rule => 'Rule',
            self::Seeder => 'Seeders',
            self::Service => 'Services',
        };
    }

    public function stubFilename(): string
    {
        return match ($this) {
            self::Command => 'TestCommand.php.stub',
            self::Component => 'TestComponent.php.stub',
            self::Controller => 'TestController.php.stub',
            self::Dto => 'TestDto.php.stub',
            self::Event => 'TestEvent.php.stub',
            self::Factory => 'TestFactory.php.stub',
            self::FormRequest => 'TestFormRequest.php.stub',
            self::Job => 'TestJob.php.stub',
            self::Listener => 'TestListener.php.stub',
            self::Mail => 'TestMail.php.stub',
            self::Middleware => 'TestMiddleware.php.stub',
            self::Migration => 'TestMigration.php.stub',
            self::Model => 'TestModel.php.stub',
            self::Notification => 'TestNotification.php.stub',
            self::Policy => 'TestPolicy.php.stub',
            self::Resource => 'TestResource.php.stub',
            self::Route => 'TestRoute.php.stub',
            self::Rule => 'TestRule.php.stub',
            self::Seeder => 'TestSeeder.php.stub',
            self::Service => 'TestService.php.stub',
        };
    }

    public function outputFilename(): string
    {
        return str_replace('.stub', '', $this->stubFilename());
    }
}
