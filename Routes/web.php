<?php
use App\Core\Router;
use App\Controllers\ShopController;

Router::get('/', [ShopController::class, 'index']);
Router::get('/shop', [ShopController::class, 'index']);
Router::post('/shop/redeem', [ShopController::class, 'redeem']);