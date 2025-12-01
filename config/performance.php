<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Performance Optimization Settings
    |--------------------------------------------------------------------------
    |
    | This file contains performance optimization settings for the application.
    |
    */

    'cache' => [
        'contact_counts' => [
            'enabled' => true,
            'ttl' => 300, // 5 minutes
        ],
    ],

    'database' => [
        'pagination' => [
            'default_per_page' => 10,
            'max_per_page' => 50,
        ],
        'query_optimization' => [
            'select_specific_columns' => true,
            'use_indexes' => true,
        ],
    ],

    'assets' => [
        'minify_css' => true,
        'minify_js' => true,
        'combine_files' => true,
        'lazy_load_images' => true,
    ],

    'frontend' => [
        'lazy_loading' => true,
        'preload_critical_resources' => true,
        'defer_non_critical_js' => true,
    ],
];
