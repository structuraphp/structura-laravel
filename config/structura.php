<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Output Directory
    |--------------------------------------------------------------------------
    |
    | The directory where the architecture test files will be generated.
    |
    */
    'output_dir' => 'tests/Architecture',

    /*
    |--------------------------------------------------------------------------
    | Output Namespace
    |--------------------------------------------------------------------------
    |
    | The namespace prefix for the generated architecture test classes.
    |
    */
    'output_namespace' => 'Tests\Architecture',

    /*
    |--------------------------------------------------------------------------
    | Source Paths
    |--------------------------------------------------------------------------
    |
    | The source paths associated with each stub category.
    |
    */
    'paths' => [
        'controller' => 'app/Http/Controllers',
        'dto' => 'app/Dto',
        'event' => 'app/Events',
        'factory' => 'database/factories',
        'form_request' => 'app/Http/Requests',
        'job' => 'app/Jobs',
        'listener' => 'app/Listeners',
        'mail' => 'app/Mail',
        'middleware' => 'app/Http/Middleware',
        'model' => 'app/Models',
        'notification' => 'app/Notifications',
        'policy' => 'app/Policies',
        'route' => 'routes',
        'service' => 'app/Services',
    ],
];
