<?php
declare(strict_types = 1);

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

    public function isAperoMaison(): bool
    {
        $quadrapero = clone($this->now);
        $quadrapero->modify('third thursday of this month 19:00:00');

        return (
            $this->now->diff($quadrapero)->invert === 0
            && $this->now->diff($quadrapero)->d === 0
            && $this->now->diff($quadrapero)->h <= 19
        );
    }

    public function isToday(): bool
    {
        $firstJeudi = $this->getThisFirstJeudi();

        return (
            $this->now->diff($firstJeudi)->invert === 0
            && $this->now->diff($firstJeudi)->d === 0
            && $this->now->diff($firstJeudi)->h <= 20
        );
    }

    public function isThisWeek(): bool
    {
        $firstJeudi = $this->getThisFirstJeudi();
        $nextFirstJeudi = $this->getNextFirstJeudi();

        return (
            (!$this->now->diff($firstJeudi)->invert && $this->now->diff($firstJeudi)->d < 7)
            || ($this->now->diff($firstJeudi)->invert && $this->now->diff($nextFirstJeudi)->d < 7)
        );
    }

    public function getNext(): \DateTime
    {
        $firstJeudi = $this->getThisFirstJeudi();

        if ($this->now->diff($firstJeudi)->invert) {
            $firstJeudi = $this->getNextFirstJeudi();
        }
        return $firstJeudi;
    }

    public function toArray(): array
    {
        return [
            'is_first_jeudi' => $this->isToday(),
            'is_first_week' => $this->isThisWeek(),
            'next_first_jeudi' => $this->getNext()->format('Y-m-d'),
            'is_aperomaison' => $this->isAperoMaison(),
        ];
    }

    private function getThisFirstJeudi(): \DateTime
    {
        $firstJeudi = clone($this->now);
        $firstJeudi->modify('first thursday of this month 20:00:00');

        return $firstJeudi;
    }

    private function getNextFirstJeudi(): \DateTime
    {
        $nextFirstJeudi = clone($this->now);
        $nextFirstJeudi->modify('first thursday of next month 20:00:00');

        return $nextFirstJeudi;
    }
}
