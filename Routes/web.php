<?php

use App\Core\Router;
use App\Controllers\ShopController;
use App\Controllers\AuthController;
use App\Controllers\PointsController;

Router::get('/', [ShopController::class, 'index']);

Router::get('/login', [AuthController::class, 'login']);
Router::get('/register', [AuthController::class, 'register']);
Router::post('/register', [AuthController::class, 'submitregister']);
Router::post('/login', [AuthController::class, 'submitLogin']);
Router::post('/logout', [AuthController::class, 'logout']);
Router::get('/reward', [ShopController::class, 'reward']);
Router::get('/transactions', [PointsController::class, 'transactions']);

Router::get('/checkout', [ShopController::class, 'checkout']);
Router::get('/shop', [ShopController::class, 'shop']);

Router::post('/cart/add', [ShopController::class, 'addToCart']);
Router::post('/cart/empty', [ShopController::class, 'emptyCart']);

Router::post('/purchase', [ShopController::class, 'emptyCart']);
