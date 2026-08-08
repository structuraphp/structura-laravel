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
        'form_request' => 'app/Http/Requests',
        'model' => 'app/Models',
        'policy' => 'app/Policies',
        'factory' => 'database/factories',
        'event' => 'app/Events',
        'listener' => 'app/Listeners',
        'middleware' => 'app/Http/Middleware',
        'route' => 'routes',
        'job' => 'app/Jobs',
        'mail' => 'app/Mail',
        'notification' => 'app/Notifications',
        'service' => 'app/Services',
    ],
];
