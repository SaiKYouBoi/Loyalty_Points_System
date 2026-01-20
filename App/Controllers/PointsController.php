<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Helpers\Session;
use App\Models\Point;
use App\Models\User;
use Database\Database;
use Exception;

class PointsController extends Controller
{
    private Point $points;

    public function __construct()
    {

        $this->points = new Point();
    }
    public function transactions(): void
    {

        $transactions = $this->points->getAlltransaction();

        $this->view('transactions.view.twig', ['transactions' => $transactions]);
    }

    public function addPoints()
    {
        try {

            Session::start();

            $userId = $_SESSION['user_id'];

            $total = $_POST['total'];

            $amount = round($_POST['total'] / 10);

            Database::getInstance()->beginTransaction();

            $stmt = Database::getInstance()->prepare("INSERT INTO orders (user_id,total_amount) VALUES (:user_id , :total_amount)");

            $stmt->execute([
                ':user_id' => $userId,
                ':total_amount' => $total
            ]);

            $totalpoints = (new User())->totalPoints();

            $balanceafter = $totalpoints['total_points'] + $amount;

            $stmtpoints = Database::getInstance()->prepare("INSERT INTO points_transactions (user_id,type,amount,balance_after) VALUES (:user_id,:type,:amount,:balance_after)");

            $stmtpoints->execute([
                ':user_id' => $userId,
                ':type' => 'earned',
                ':amount' => $amount,
                ':balance_after' => $balanceafter,
            ]);

            $stmtupdatepoints = Database::getInstance()->prepare("UPDATE users SET total_points = :totalpoints WHERE id = :id");

            $stmtupdatepoints->execute([
                ':totalpoints' => $balanceafter,
                ':id' => $userId
            ]);

            if (Database::getInstance()->commit()) {
                Session::flash('success', 'Order saved successfully');
                unset($_SESSION['cart']);
                header('Location: /shop');

            }

        } catch (Exception $e) {

            Database::getInstance()->rollBack();
            echo "Transaction failed: " . $e->getMessage();
        }
    }

    public function RedeemPoints()
    {
        try {
            Session::start();

            $userId = $_SESSION['user_id'];

            $rewardPoints = (int) $_POST['reward_points'];

            Database::getInstance()->beginTransaction();

            $totalpoints = (new User())->totalPoints();

            $balanceafter = $totalpoints['total_points'] - $rewardPoints;


            $stmtredeempoints = Database::getInstance()->prepare("INSERT INTO points_transactions (user_id,type,amount,balance_after) VALUES (:user_id,:type,:amount,:balance_after)");
            $stmtredeempoints->execute([
                ':user_id' => $userId,
                ':type' => 'redeemed',
                ':amount' => $rewardPoints,
                ':balance_after' => $balanceafter
            ]);

            $stmtupdatepoints = Database::getInstance()->prepare("UPDATE users SET total_points = :totalpoints WHERE id = :id");

            $stmtupdatepoints->execute([
                ':totalpoints' => $balanceafter,
                ':id' => $userId
            ]);

         
            if (Database::getInstance()->commit()) {
                Session::flash('success', 'Reward redeemed successfully');
                header('Location: /transactions');
            }


        } catch (Exception $e) {

            Database::getInstance()->rollBack();
            echo "Transaction failed: " . $e->getMessage();
        }
    }
}