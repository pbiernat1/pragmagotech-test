<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Exception\ValidatorException;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\LoanValidator\AllowedValuesValidatorExtension;
use PragmaGoTech\Interview\Service\LoanValidator\MaxValueValidatorExtension;
use PragmaGoTech\Interview\Service\LoanValidator\MinValueValidatorExtension;
use PragmaGoTech\Interview\Service\LoanValidator\Validator;

class FeeCalculatorTest extends TestCase
{
    private const ONE_YEAR  = 12;
    private const TWO_YEARS = 24;

    private const VALUE_OVER_RANGE    = 100000;

    public function testInvalidLoanTermValue()
    {
        $loanTermValidator = new Validator(
            new AllowedValuesValidatorExtension([static::ONE_YEAR, static::TWO_YEARS])
        );
        $loanAmountValidator = new Validator(
            new MinValueValidatorExtension(1000),
            new MaxValueValidatorExtension(20000)
        );
        $calculator = FeeCalculator::create($loanTermValidator, $loanAmountValidator);
        
        $this->expectException(ValidatorException::class);
    
        $application = LoanProposal::create(13, 19250);
        $fee = $calculator->calculate($application);
    }

    public function testLoanAmountOverBound()
    {
        $loanTermValidator = new Validator(
            new AllowedValuesValidatorExtension([static::ONE_YEAR, static::TWO_YEARS])
        );
        $loanAmountValidator = new Validator(
            new MinValueValidatorExtension(1000),
            new MaxValueValidatorExtension(20000)
        );
        $calculator = FeeCalculator::create($loanTermValidator, $loanAmountValidator);
        
        $this->expectException(ValidatorException::class);
    
        $application = LoanProposal::create(static::ONE_YEAR, static::VALUE_OVER_RANGE);
        $fee = $calculator->calculate($application);
        dump($fee);exit;
    }

    public function testSuccessfullyCalculations()
    {
        $loanTermValidator = new Validator(
            new AllowedValuesValidatorExtension([12, 24])
        );
        $loanAmountValidator = new Validator(
            new MinValueValidatorExtension(1000),
            new MaxValueValidatorExtension(20000)
        );
        $calculator = FeeCalculator::create($loanTermValidator, $loanAmountValidator);
    
        $application1 = LoanProposal::create(12, 19250);
        $fee1 = $calculator->calculate($application1);

        $application2 = LoanProposal::create(24, 11500);
        $fee2 = $calculator->calculate($application2);

        $this->assertSame((float)385, $fee1);
        $this->assertSame((float)460, $fee2);
    }
}
