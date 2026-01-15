<?php
namespace App\Controllers;

use App\Core\Controller;

class ShopController extends Controller
{
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
}
