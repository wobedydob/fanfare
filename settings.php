<?php

// determines if errors should be displayed
$errors = true;

if ($errors) {
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
}

if (PHP_VERSION < '8.0') {
    throw new \Exception('"🎺 Fanfare" does not support PHP version: ' . PHP_VERSION);
}
