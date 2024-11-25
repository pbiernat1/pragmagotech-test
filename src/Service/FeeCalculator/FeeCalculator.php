<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator;

use PragmaGoTech\Interview\Exception\InvalidLoanException;
use PragmaGoTech\Interview\Interface\FeeCalculator as FeeCalculatorInterface;
use PragmaGoTech\Interview\Service\LoanValidator\Validator;
use PragmaGoTech\Interview\Model\LoanProposal;

class FeeCalculator implements FeeCalculatorInterface
{
    private $validators = [];

    private function __construct(Validator ...$validators)
    {
        $this->validators = $validators;
    }

    public static function create(Validator ...$validators)
    {
        return new static(...$validators);
    }

    /**
     * @return float
     * @throws InvalidLoanException
     */
    public function calculate(LoanProposal $application): float
    {
        foreach ($this->validators as $validator)
        if (!$validator->run($application)) {
            throw new InvalidLoanException();
        }

        return 0.0;
    }
}
