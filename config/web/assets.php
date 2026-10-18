<?php

/*
 * Frontend asset lists. Loaded in order by resources/views/frontend/layoutIndex.blade.php.
 * The design lives in assets/app/site.css; keep vendor files minimal.
 */

$frontend_css = [
    "assets/css/bootstrap.min.css",
    "assets/css/bootstrap-icons.css",
    "assets/css/all.min.css",
    "assets/app/site.css",
];

$frontend_js = [
    "assets/js/vendor/jquery-3.6.2.min.js",
];

return [
    "frontend" => [
        "css" => $frontend_css,
        "js" => $frontend_js,
    ],
    "backend" => [
        "css" => [],
        "js" => [],
    ]
];
