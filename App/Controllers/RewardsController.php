<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Reward;
use App\Models\User;

class RewardsController extends Controller
{   
    public function rewards()
    {
        $rewards = Reward::getAll();
        $total = (new User)->totalPoints();


        $this->view('rewards.view.twig', [
            'rewards' => $rewards,
            'total_points' => $total['total_points']
        ]);
    }


}