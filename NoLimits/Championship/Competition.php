<?php
namespace NoLimits\Championship;

use Support\Database\Model;

class Competition extends Model
{
    public function getPrice(): float
    {
        return $this->price / 100;
    }

    public function game()
    {
        return $this->embedsOne(Game::class, 'game');
    }
}
