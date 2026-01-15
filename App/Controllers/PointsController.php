<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Helpers\Session;

class PointsController extends Controller
{
    public function transactions(): void
    {
        $this->view('transactions.view.twig');
    }
}