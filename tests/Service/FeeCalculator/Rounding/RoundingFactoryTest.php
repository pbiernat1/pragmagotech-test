<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Test;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Service\FeeCalculator\Rounding\RoundingFactory;
use PragmaGoTech\Interview\Service\FeeCalculator\Rounding\RoundUpToFive;
use PragmaGoTech\Interview\Service\FeeCalculator\Rounding\RoundUpToFiveRounding;

class RoundingFactoryTest extends TestCase
{
    public function testSuccessfullyCreatedRoundUpToFiveObject()
    {
        $roundingObject = RoundingFactory::create();

        $this->assertEquals(RoundUpToFiveRounding::class, get_class($roundingObject));
    }
}
