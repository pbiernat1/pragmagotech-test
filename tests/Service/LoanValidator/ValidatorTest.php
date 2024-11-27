<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Test;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\LoanValidator\AllowedValuesValidatorExtension;
use PragmaGoTech\Interview\Service\LoanValidator\MaxValueValidatorExtension;
use PragmaGoTech\Interview\Service\LoanValidator\MinValueValidatorExtension;
use PragmaGoTech\Interview\Service\LoanValidator\Validator;

class ValidatorTest extends TestCase
{
    private const ONE_YEAR  = 12;
    private const TWO_YEARS = 24;

    public function testMinAmountExtensionAgainstOutOfBoundValue()
    {
        $validator = new Validator(
            new MinValueValidatorExtension(1000)
        );
        $application = LoanProposal::create(static::ONE_YEAR, 900);

        $this->assertFalse($validator->run($application));
    }

    public function testMinAmountExtensionCorrectValue()
    {
        $validator = new Validator(
            new MinValueValidatorExtension(1000)
        );
        $application1 = LoanProposal::create(static::ONE_YEAR, 1000);
        $application2 = LoanProposal::create(static::ONE_YEAR, 1100);

        $this->assertTrue($validator->run($application1));
        $this->assertTrue($validator->run($application2));
    }

    public function testMaxAmountExtensionAgainstOutOfBoundValue()
    {
        $validator = new Validator(
            new MaxValueValidatorExtension(1000)
        );
        $application = LoanProposal::create(static::ONE_YEAR, 1100);

        $this->assertFalse($validator->run($application));
    }

    public function testMaxAmountExtensionCorrectValue()
    {
        $validator = new Validator(
            new MaxValueValidatorExtension(1000)
        );
        $application1 = LoanProposal::create(static::ONE_YEAR, 900);
        $application2 = LoanProposal::create(static::ONE_YEAR, 1000);

        $this->assertTrue($validator->run($application1));
        $this->assertTrue($validator->run($application2));
    }

    public function testAllowedTermsExtensionAgainstOutOfBoundValue()
    {
        $validator = new Validator(
            new AllowedValuesValidatorExtension([static::ONE_YEAR, static::TWO_YEARS])
        );
        $application = LoanProposal::create(48, 2500);

        $this->assertFalse($validator->run($application));
    }

    public function testAllowedTermsExtensionCorrectValue()
    {
        $validator = new Validator(
            new AllowedValuesValidatorExtension([static::ONE_YEAR, static::TWO_YEARS])
        );
        $application1 = LoanProposal::create(static::ONE_YEAR, 1000);
        $application2 = LoanProposal::create(static::TWO_YEARS, 2000);

        $this->assertTrue($validator->run($application1));
        $this->assertTrue($validator->run($application2));
    }
}