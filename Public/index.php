<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/../App/Helpers/functions.php";

use App\Core\Router;


require_once __DIR__ . '/../Routes/web.php';

            
Router::dispatch();