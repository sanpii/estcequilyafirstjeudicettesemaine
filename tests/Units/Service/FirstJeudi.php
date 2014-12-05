<?php

namespace AppBundle\Test\Units\Service;

class FirstJeudi extends \Atoum
{
    private $firstJeudi;

    public function beforeTestMethod($testMethod)
    {
        $className = $this->getTestedClassName();
        $this->firstJeudi = new $className();
    }

    public function testInit()
    {
        $this->object($this->firstJeudi)
            ->isInstanceOf('\AppBundle\Service\FirstJeudi');
    }

    public function testWeAreFirstJeudi()
    {
        $className = $this->getTestedClassName();
        $firstJeudi = new $className('2014-12-04');

        $this->boolean($firstJeudi->isToday())
            ->isTrue();
    }

    public function testWeAreNotFirstJeudi()
    {
        $className = $this->getTestedClassName();
        $firstJeudi = new $className('2014-12-03 21:00:00');

        $this->boolean($firstJeudi->isToday())
            ->isFalse();

        $className = $this->getTestedClassName();
        $firstJeudi = new $className('2014-12-05 10:00:00');

        $this->boolean($firstJeudi->isToday())
            ->isFalse();
    }

    public function testWeAreNotFirstJeudiWeek()
    {
        $className = $this->getTestedClassName();
        $firstJeudi = new $className('2014-12-08');

        $this->boolean($firstJeudi->isThisWeek())
            ->isFalse();
    }

    public function testGetNext()
    {
        $className = $this->getTestedClassName();
        $firstJeudi = new $className('2014-12-03');
        $next = $firstJeudi->getNext();

        $this->object($next)
            ->isInstanceOf('\DateTime');

        $this->string($next->format('Y-m-d'))
            ->isIdenticalTo('2014-12-04');

        $className = $this->getTestedClassName();
        $firstJeudi = new $className('2014-11-10');
        $next = $firstJeudi->getNext();

        $this->string($next->format('Y-m-d'))
            ->isIdenticalTo('2014-12-04');

    }

    public function testToArray()
    {
        $className = $this->getTestedClassName();
        $firstJeudi = new $className('2014-12-03');

        $this->array($firstJeudi->toArray())
            ->isIdenticalTo([
                'is_first_jeudi' => false,
                'is_first_week' => true,
                'next_first_jeudi' => '2014-12-04',
            ]);
    }
}
