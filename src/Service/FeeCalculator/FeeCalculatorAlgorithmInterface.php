<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator;

interface FeeCalculatorAlgorithmInterface
{
    public function calculate(float $loanAmount): float;
}
