<?php

use Slim\Http\Request;
use Slim\Http\Response;

use Insta\Controllers as C;

/**
 * There appear to be a few ways to do routes.
 * 1. passing an array [UserController::class, 'create'] will call create statically
 * 2. Create a Controller for each route action. This means lots of files in the project. Too messy.
 * ---
 * This way will use the container resolution. new UserController($container)
 * and the Controller will be able to access the view stored from the container easily.
 */

$app->get('/', C\UserController::class .':create')->setName('user.create');
$app->post('/', C\UserController::class . ':store')->setName('user.store');

// Example URLs
$app->get('/e1', C\ExampleController::class .':index')->setName('example1');
$app->get('/e2', C\ExampleController::class .':index')->setName('example2');
$app->get('/e3', C\ExampleController::class .':index')->setName('example3');
$app->get('/e4', C\ExampleController::class .':index')->setName('example4');
