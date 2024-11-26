<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator;

use PragmaGoTech\Interview\Exception\InvalidLoanException;
use PragmaGoTech\Interview\Exception\ValidatorException;
use PragmaGoTech\Interview\Interface\FeeCalculator as FeeCalculatorInterface;
use PragmaGoTech\Interview\Interface\Validator as ValidatorInterface;
use PragmaGoTech\Interview\Service\LoanValidator\Validator;
use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\BreakpointFactory;
use PragmaGoTech\Interview\Service\FeeCalculator\Rounding\RoundingFactory;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\BreakpointMatcher;

class FeeCalculator implements FeeCalculatorInterface
{
    private $validators = [];

    private function __construct(Validator ...$validators) {
        $this->validators = $validators;
    }

    public static function create(Validator ...$validators) {
        return new static(...$validators);
    }

    /**
     * @return float
     * @throws InvalidLoanException
     */
    public function calculate(LoanProposal $application): float
    {
        /** @var ValidatorInterface $validator */
        foreach ($this->validators as $validator) {
            if (!$validator->run($application)) {
                throw new ValidatorException('Invalid loan parameters');
            }
        }

        return $this->calculateFee($application->amount(), $application->term());
    }

    private function calculateFee(float $loanAmount, int $term)
    {
        $breakpoints = BreakpointFactory::create($term)
            ->getBreakpoints();

        $breakpointsMatcher = BreakpointMatcher::create($breakpoints);
        $breakpointsMatcher->calculate($loanAmount);

        $lowerBreakpoint = $breakpointsMatcher->getLowerValue();
        $upperBreakpoint = $breakpointsMatcher->getUpperValue();

        if ($loanAmount == $upperBreakpoint) {
            return $breakpoints[$upperBreakpoint];
        }

        $lowerFee = $breakpoints[$lowerBreakpoint];
        $upperFee = $breakpoints[$upperBreakpoint];

        $lowerAmount = $lowerBreakpoint;
        $upperAmount = $upperBreakpoint;

        $fee = $lowerFee + (($loanAmount - $lowerAmount) / ($upperAmount - $lowerAmount)) * ($upperFee - $lowerFee);

        $rounding = RoundingFactory::create();// at this moment we have only RoundUpToFive class

        $totalAmount = $loanAmount + $fee;
        $roundUpToFive = $rounding->round($totalAmount);
        $fee = $roundUpToFive - $loanAmount;

        return round($fee, 2);
    }
}
