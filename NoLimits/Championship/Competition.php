<?php
namespace NoLimits\Championship;

use MongolidLaravel\MongolidModel;

class Competition extends MongolidModel
{
    public function game()
    {
        return $this->embedsOne(Game::class, 'game');
    }
}
