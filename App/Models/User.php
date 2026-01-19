<?php
namespace App\Models;

use App\Helpers\Session;
use Database\Database;
use DateTime;
use PDO;

class User
{
    private ?int $id;
    private ?string $email;
    private ?string $password;
    private ?string $name;
    private ?int $totalPoints;
    private ?DateTime $createdAt;

    public function __construct(array $data = [])
    {
        $this->id = (int) ($data['id'] ?? null);
        $this->email = $data['email']?? null;
        $this->password = $data['password_hash'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->totalPoints = $data['total_points'] ?? 0;
        $this->createdAt = new DateTime($data['created_at'] ?? '');
    }

    public  function findByEmail(string $email): ?self
    {
        $stmt = Database::getInstance()->prepare(
            "SELECT * FROM users WHERE email = ? LIMIT 1"
        );
        $stmt->execute([$email]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new self($data) : null;
    }

    public function emailExists(string $email): bool
    {
        $stmt = Database::getInstance()->prepare(
            "SELECT 1 FROM users WHERE email = ?"
        );
        $stmt->execute([$email]);

        return $stmt->rowCount() > 0;
    }

    public function create(string $name, string $email, string $password): bool
    {
        $stmt = Database::getInstance()->prepare(
            "INSERT INTO users (name, email, password_hash)
             VALUES (?, ?, ?)"
        );

        return $stmt->execute([
            $name,
            $email,
            password_hash($password, PASSWORD_BCRYPT)
        ]);
    }

    public function totalPoints()
    {
        Session::start();
        
        $stmt = Database::getInstance()->prepare("SELECT total_points FROM users WHERE id = :id");
        $stmt->execute([':id' => $_SESSION['user_id']]);
        
        return $stmt->fetch();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->password;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getTotalPoints(): int
    {
        return $this->totalPoints;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}