<?php
namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Lexer;


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

            self::registerLexer();
        }

        echo self::$twig->render($template, $data);
    }

    private static function registerLexer(): void
    {
        $lexer = new Lexer(self::$twig, [
            'tag_block'    => ['{@', '@}'],   
            'tag_variable' => ['{{', '}}'],  
            'tag_comment'  => ['{#', '#}'],   
        ]);

        self::$twig->setLexer($lexer);
    }
    
}
