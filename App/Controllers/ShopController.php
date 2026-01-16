<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\ProductModel;

class ShopController extends Controller
{   
    private ProductModel $products;

    public function __construct(ProductModel $products)
    {
        $this->products = $products;
    }

    

    public function index(): void
    {
        $this->view('home.view.twig');
    }
    public function reward(): void
    {
        $this->view('rewards.view.twig');
    }

    public function shop(): void
    {   
        $products = $this->products->all();

        $this->view('shop.view.twig', [
            'products' => $products
        ]);
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


