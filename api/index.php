<?php

// Set the base path for Laravel

// Set the app base path so Laravel knows where it lives
$_ENV['APP_BASE_PATH'] = dirname(__DIR__);

// Vercel runs from the /api directory, so we need to
// tell PHP where the document root actually is
$_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__) . '/public';

// Forward all requests to Laravel's public/index.php
require dirname(__DIR__) . '/public/index.php';
