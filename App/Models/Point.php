<?php
namespace App\Models;

use DateTime;

class Point
{
   private int $id;
    private User $user;
    private string $type;
    private int $amount;
    private ?string $description;
    private int $balanceAfter;
    private DateTime $createdAt;

    public function __construct(
        int $id,
        User $user,
        string $type,
        int $amount,
        ?string $description,
        int $balanceAfter,
        DateTime $createdAt
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

}