<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator;

use PragmaGoTech\Interview\Exception\ValidatorException;
use PragmaGoTech\Interview\Interface\FeeCalculatorInterface;
use PragmaGoTech\Interview\Interface\ValidatorInterface;
use PragmaGoTech\Interview\Service\LoanValidator\Validator;
use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\BreakpointFactory;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\BreakpointMatcher;

class FeeCalculator implements FeeCalculatorInterface
{
    /**
     * @var array<ValidatorInterface>
     */
    private $validators = [];

    private function __construct(Validator ...$validators)
    {
        $this->validators = $validators;
    }

    public static function create(Validator ...$validators): self
    {
        return new self(...$validators);
    }

    /**
     * @return float
     * @throws ValidatorException
     */
    public function calculate(LoanProposal $application): float
    {
        /** @var ValidatorInterface $validator */
        foreach ($this->validators as $validator) {
            if (!$validator->run($application)) {
                throw new ValidatorException('Invalid loan parameters');
            }
        }

        $fee = $this->calculateFee($application->amount(), $application->term());

        return round($fee, 2);
    }

    private function calculateFee(float $loanAmount, int $term): float
    {
        $breakpointGenerator = BreakpointFactory::create($term);
        $baseCalculator = FeeCalculatorBaseAlgorithm::create($breakpointGenerator);
        
        return $baseCalculator->calculate($loanAmount);
    }
}
