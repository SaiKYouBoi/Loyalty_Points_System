<?php
namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    private static ?Environment $twig = null;

    public static function render(string $template, array $data = []): void
    {
        if (self::$twig === null) {
            $loader = new FilesystemLoader(__DIR__ . '/../../Views');

            self::$twig = new Environment($loader, [
                'cache' => false, // enable in production
                'debug' => true
            ]);
        }

        echo self::$twig->render($template, $data);
    }
}
