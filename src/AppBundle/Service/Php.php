<?php

namespace AppBundle\Service;

class Php implements FirstJeudi
{
    private $now;

    public function __construct($now = 'now')
    {
        if (!$now instanceof \Datetime) {
            $now = new \Datetime($now);
        }
        $this->now = $now;
    }

    public function isToday()
    {
        $firstJeudi = $this->getThisFirstJeudi();

        return (
            $this->now->diff($firstJeudi)->invert === 0
            && $this->now->diff($firstJeudi)->d === 0
            && $this->now->diff($firstJeudi)->h <= 20
        );
    }

    public function isThisWeek()
    {
        $firstJeudi = $this->getThisFirstJeudi();
        $nextFirstJeudi = $this->getNextFirstJeudi();

        return (
            (!$this->now->diff($firstJeudi)->invert && $this->now->diff($firstJeudi)->d < 7)
            || ($this->now->diff($firstJeudi)->invert && $this->now->diff($nextFirstJeudi)->d < 7)
        );
    }

    public function getNext()
    {
        $firstJeudi = $this->getThisFirstJeudi();

        if ($this->now->diff($firstJeudi)->invert) {
            $firstJeudi = $this->getNextFirstJeudi();
        }
        return $firstJeudi;
    }

    public function toArray()
    {
        return [
            'is_first_jeudi' => $this->isToday(),
            'is_first_week' => $this->isThisWeek(),
            'next_first_jeudi' => $this->getNext()->format('Y-m-d'),
        ];
    }

    private function getThisFirstJeudi()
    {
        $firstJeudi = clone($this->now);
        $firstJeudi->modify('first thursday of this month 20:00:00');

        return $firstJeudi;
    }

    private function getNextFirstJeudi()
    {
        $nextFirstJeudi = clone($this->now);
        $nextFirstJeudi->modify('first thursday of next month 20:00:00');

        return $nextFirstJeudi;
    }
}
