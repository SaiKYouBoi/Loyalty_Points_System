<?php
namespace App\Controllers;

use App\Core\Controller;

class ShopController extends Controller
{
    public function index(): void
    {
        $this->view('index.view.twig', [
            'title' => 'ilias'
        ]);
    }

    public function redeem(): void
    {
        // handle POST logic here
        echo "Reward redeemed";
    }
}
