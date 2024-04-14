<?php

use Vikuraa\Modules\Login\LoginController;

$route->post('/login', LoginController::class . ':login');