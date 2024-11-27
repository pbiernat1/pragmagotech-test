<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Test;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Service\FeeCalculator\Rounding\RoundingFactory;
use PragmaGoTech\Interview\Service\FeeCalculator\Rounding\RoundUpToFive;

class RoundingFactoryTest extends TestCase
{
    public function testSuccessfullyCreatedRoundUpToFiveObject()
    {
        $roundingObject = RoundingFactory::create();

        $this->assertEquals(RoundUpToFive::class, get_class($roundingObject));
    }
}
