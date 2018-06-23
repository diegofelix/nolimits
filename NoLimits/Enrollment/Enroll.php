<?php
namespace NoLimits\Championship;

use MongolidLaravel\MongolidModel;

class Enroll extends MongolidModel
{
    public function championship()
    {
        return $this->referencesOne(Championship::class, 'championship');
    }

    public function competitions()
    {
        return $this->embedsMany(Competition::class, 'competitions');
    }
}
