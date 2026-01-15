<?php

use App\Core\Router;
use App\Controllers\ShopController;
use App\Controllers\AuthController;

Router::get('/', [ShopController::class, 'index']);
Router::get('/shop', [ShopController::class, 'index']);
Router::get('/login', [AuthController::class, 'login']);
Router::get('/register', [AuthController::class, 'register']);
Router::post('/register', [AuthController::class, 'submitregister']);
Router::post('/login', [AuthController::class, 'submitLogin']);
Router::post('/logout', [AuthController::class, 'logout']);
