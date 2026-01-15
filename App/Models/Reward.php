<?php 

namespace App\Models;

class Reward
{
    private int $id;
    private string $name;
    private int $pointsRequired;
    private ?string $description;
    private int $stock;

    public function __construct(
        int $id,
        string $name,
        int $pointsRequired,
        ?string $description,
        int $stock
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->pointsRequired = $pointsRequired;
        $this->description = $description;
        $this->stock = $stock;
    }


}