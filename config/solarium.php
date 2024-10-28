<?php

return [
    'endpoint' => [
        'default' => [
            'scheme' => env('SOLR_SCHEME', 'http'),
            'host' => env('SOLR_HOST', ''),
            'port' => env('SOLR_PORT', '8983'),
            'path' => env('SOLR_PATH', '/solr'),
            'core' => env('SOLR_CORE', 'example'),
        ]
    ]
];
