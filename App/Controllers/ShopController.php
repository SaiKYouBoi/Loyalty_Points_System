<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\ProductModel;
use Database\Database;

class ShopController extends Controller
{

    private ProductModel $products;

    public function __construct()
    {

        $this->products = new ProductModel();
    }
    public function shop(): void
    {

        $products = $this->products->all();

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


    public function redeem(): void
    {
        // handle POST logic here
        echo "Reward redeemed";
    }

    public function addToCart(): void
    {
        session_start();

        $productId = (int) $_POST['product_id'];

        $product = $this->products->find($productId);
        if (!$product) {
            header('Location: /shop');
            exit;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity']++;
        } else {
            $_SESSION['cart'][$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image_url'],
                'quantity' => 1
            ];
        }

        header('Location: /shop');
    }

    public function checkout(): void
    {
        session_start();

        $cart = $_SESSION['cart'] ?? [];

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $this->view('checkout.view.twig', [
            'cart' => $cart,
            'total' => $total
        ]);
    }

    public function emptyCart()
    {
        session_start();
        unset($_SESSION['cart']);
        $this->view('home.view.twig');
    }

    public function addPoints()
    {

    }

}