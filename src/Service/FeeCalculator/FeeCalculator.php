<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator;

use PragmaGoTech\Interview\Exception\InvalidLoanTermException;
use PragmaGoTech\Interview\Interface\FeeCalculator as FeeCalculatorInterface;
use PragmaGoTech\Interview\Interface\LoanProposalValidator;
use PragmaGoTech\Interview\Model\LoanProposal;

class FeeCalculator implements FeeCalculatorInterface
{
    private function __construct(private LoanProposalValidator $validator)
    {
    }

    public static function create(LoanProposalValidator $validator)
    {
        return new static($validator);
    }

    /**
     * @return float
     * @throws InvalidLoanTermException
     */
    public function calculate(LoanProposal $application): float
    {
        if (!$this->validator->validate($application)) {
            throw new InvalidLoanTermException();
        }

        return 0.0;
    }
}
