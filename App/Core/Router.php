<?php
namespace App\Core;

use App\Controllers\ShopController;

class Router
{
    public function dispatch(): void
    {
        $uri = $_SERVER['REQUEST_URI'];


        if ($uri === '/' || $uri === '/home') {
            (new ShopController())->index();
            return;
        }

        http_response_code(404);
        echo '404 Not Found';
    }
}
