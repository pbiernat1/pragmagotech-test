<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
class LoanProposal
{
    private int $term;

    private float $amount;

    private function __construct(int $term, float $amount)
    {
        $this->term = $term;
        $this->amount = $amount;
    }

    public static function create(int $term, float $amount): LoanProposal
    {
        return new self($term, $amount);
    }

    /**
     * Term (loan duration) for this loan application
     * in number of months.
     */
    public function term(): int
    {
        return $this->term;
    }

    /**
     * Amount requested for this loan application.
     */
    public function amount(): float
    {
        return $this->amount;
    }
}
