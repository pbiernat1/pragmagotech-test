<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Interface;

interface RoundingInterface
{
    public function round(float $amount): float;
}
