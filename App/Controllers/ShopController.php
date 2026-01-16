<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use Database\Database;

class ShopController extends Controller
{   

    public function shop(): void
    {   
        $stmt = Database::getInstance()->query("SELECT * FROM products");

        $products = $stmt->fetchAll();

        $this->view('shop.view.twig', [
            'products' => $products
        ]);
    }
    
    
    public function index(): void
    {
        $this->view('home.view.twig');
    }
    public function reward(): void
    {
        $this->view('rewards.view.twig');
    }

    public function checkout(): void
    {
        $this->view('checkout.view.twig');
    }

    public function redeem(): void
    {
        // handle POST logic here
        echo "Reward redeemed";
    }
}