<?php
namespace App\Models;

use App\Helpers\Session;
use Database\Database;
use DateTime;

class Point
{
   private ?int $id;
    private ?User $user;
    private ?string $type;
    private ?int $amount;
    private ?string $description;
    private ?int $balanceAfter;
    private ?DateTime $createdAt;

    public function __construct(
        ?int $id =  null,
        ?User $user = null,
        ?string $type =  null,
        ?int $amount =  null,
        ?string $description =  null,
        ?int $balanceAfter =  null,
        ?DateTime $createdAt =  null
    ) {
        $this->id = $id;
        $this->user = $user;
        $this->type = $type;
        $this->amount = $amount;
        $this->description = $description;
        $this->balanceAfter = $balanceAfter;
        $this->createdAt = $createdAt;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getAlltransaction()
    {
         Session::start();
        $stmt = Database::getInstance()->prepare("SELECT * FROM points_transactions WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $_SESSION['user_id']]);
        return $stmt->fetchAll();
    }
    

}