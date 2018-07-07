<?php
namespace NoLimits\Championship;

use Support\Database\Model;

class Championship extends Model
{
    protected $collection = 'championships';

    public function competitions()
    {
        return $this->embedsMany(Competition::class, 'competitions');
    }
}
