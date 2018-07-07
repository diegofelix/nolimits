<?php
namespace NoLimits\Championship;

use NoLimits\User\User;
use Support\Database\Model;

class Enroll extends Model
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
