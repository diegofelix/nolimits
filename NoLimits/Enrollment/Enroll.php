<?php
namespace NoLimits\Championship;

use MongolidLaravel\MongolidModel;
use NoLimits\User\User;

class Enroll extends MongolidModel
{
    protected $collection = 'enrolls';

    public function user()
    {
        return $this->referencesOne(User::class, 'user');
    }

    public function championship()
    {
        return $this->referencesOne(Championship::class, 'championship');
    }

    public function competitions()
    {
        return $this->embedsMany(Competition::class, 'competitions');
    }
}
