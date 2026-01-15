<?php 
namespace App\Models;

use DateTime;

class User 
{
    private int $id;
    private string $email;
    private string $password;
    private ?string $name;
    private int $totalPoints;
    private DateTime $createdAt;

    public function __construct(
        int $id,
        string $email,
        string $password,
        ?string $name,
        int $totalPoints,
        DateTime $createdAt
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->totalPoints = $totalPoints;
        $this->createdAt = $createdAt;
    }

    public function getId(){
        return $this->id; 
    }
    
    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getTotalPoints(){
        return $this->totalPoints;
    }
}