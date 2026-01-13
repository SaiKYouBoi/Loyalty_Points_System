<?php
namespace App\Controllers;

use App\Core\Controller;

class ShopController extends Controller
{
    public function index(): void
    {
        $users = [
            ['username' => 'Alice'],
            ['username' => 'Bob']
        ];

        $this->view('home.twig', [
            'title' => 'Home',
            'users' => $users
        ]);
    }
}