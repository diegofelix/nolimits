<?php
namespace NoLimits\Championship;

use Support\Database\Model;

class Competition extends Model
{
    public function game()
    {
        return $this->embedsOne(Game::class, 'game');
    }
}
