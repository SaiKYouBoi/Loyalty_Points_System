<?php

namespace App\Models;

use Database\Database;
use PDO;

class ProductModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = Database::getInstance();
    }

    public function all(): array
    {
        $stmt = $this->db->query("SELECT * FROM products");
        return $stmt->fetchAll();
    }
}
