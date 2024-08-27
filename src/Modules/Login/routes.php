<?php

use Vikuraa\Modules\Login\LoginController;

$route->post('/login', LoginController::class . ':login');
$route->post('/refresh-token', LoginController::class . ':refreshToken');
$route->get('/get-refresh-token', LoginController::class . ':getRefreshToken'); // for testing only