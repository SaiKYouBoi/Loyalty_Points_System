<?php

namespace App\Models;

use Database\Database;
use PDO;

class ProductModel
{
    private PDO $db;

    public function __construct()
    {

        $this->db = Database::getInstance();
    }

    public function all(): array
    {
        $stmt = $this->db->query("SELECT * FROM products");
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);

        $product = $stmt->fetch();

        return $product ?: null;
    }
}
