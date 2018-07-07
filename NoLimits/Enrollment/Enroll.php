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

    public function save(bool $force = false)
    {
        if (!$this->_id) {
            $this->_id = $this->generateId();
        }

        parent::save($force);
    }

    private function generateId(): string
    {
        $date = $this->generateIdBasedOnTimestamp();
        $rand = $this->generateRandomNumber();

        return strtoupper("NL{$date}{$rand}");
    }

    private function generateIdBasedOnTimestamp(): string
    {
        return str_pad(base_convert(date('U'), 10, 20), 8, '0', STR_PAD_LEFT);
    }

    private function generateRandomNumber(): string
    {
        $rand = substr(rand(), 0, 3);

        return str_pad(base_convert($rand, 10, 20), 4, '0', STR_PAD_LEFT);
    }
}
