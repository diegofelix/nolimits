<?php
namespace NoLimits\Championship;

use MongolidLaravel\MongolidModel;

class Championship extends MongolidModel
{
    protected $collection = 'championships';

    public function competitions()
    {
        return $this->embedsMany(Competition::class, 'competitions');
    }
}
