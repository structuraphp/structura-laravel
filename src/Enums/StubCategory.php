<?php

declare(strict_types=1);

namespace StructuraPhp\StructuraLaravel\Enums;

enum StubCategory: string
{
    case Controller = 'controller';
    case Dto = 'dto';
    case FormRequest = 'form_request';
    case Model = 'model';
    case Policy = 'policy';
    case Factory = 'factory';
    case Event = 'event';
    case Listener = 'listener';
    case Middleware = 'middleware';
    case Route = 'route';
    case Job = 'job';
    case Mail = 'mail';
    case Notification = 'notification';
    case Service = 'service';

    public function label(): string
    {
        return match ($this) {
            self::Controller => 'Controllers',
            self::Dto => 'DTOs (Data Transfer Objects)',
            self::FormRequest => 'Form Requests',
            self::Model => 'Models',
            self::Policy => 'Policies',
            self::Factory => 'Factories',
            self::Event => 'Events',
            self::Listener => 'Listeners',
            self::Middleware => 'Middlewares',
            self::Route => 'Routes',
            self::Job => 'Jobs',
            self::Mail => 'Mailables',
            self::Notification => 'Notifications',
            self::Service => 'Services',
        };
    }

    public function stubFilename(): string
    {
        return match ($this) {
            self::Controller => 'ControllerTest.php.stub',
            self::Dto => 'DtoTest.php.stub',
            self::FormRequest => 'FormRequestTest.php.stub',
            self::Model => 'ModelTest.php.stub',
            self::Policy => 'PolicyTest.php.stub',
            self::Factory => 'FactoryTest.php.stub',
            self::Event => 'EventTest.php.stub',
            self::Listener => 'ListenerTest.php.stub',
            self::Middleware => 'MiddlewareTest.php.stub',
            self::Route => 'RouteTest.php.stub',
            self::Job => 'JobTest.php.stub',
            self::Mail => 'MailTest.php.stub',
            self::Notification => 'NotificationTest.php.stub',
            self::Service => 'ServiceTest.php.stub',
        };
    }

    public function outputFilename(): string
    {
        return str_replace('.stub', '', $this->stubFilename());
    }
}
