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
    public function testMinAmountExtensionAgainstOutOfBoundValue()
    {
        $validator = new Validator(
            new MinValueValidatorExtension(1000)
        );
        $application = LoanProposal::create(12, 900);

        $this->assertFalse($validator->run($application));
    }

    public function testMinAmountExtensionCorrectValue()
    {
        $validator = new Validator(
            new MinValueValidatorExtension(1000)
        );
        $application1 = LoanProposal::create(12, 1000);
        $application2 = LoanProposal::create(12, 1100);

        $this->assertTrue($validator->run($application1));
        $this->assertTrue($validator->run($application2));
    }

    public function testMaxAmountExtensionAgainstOutOfBoundValue()
    {
        $validator = new Validator(
            new MaxValueValidatorExtension(1000)
        );
        $application = LoanProposal::create(12, 1100);

        $this->assertFalse($validator->run($application));
    }

    public function testMaxAmountExtensionCorrectValue()
    {
        $validator = new Validator(
            new MaxValueValidatorExtension(1000)
        );
        $application1 = LoanProposal::create(12, 900);
        $application2 = LoanProposal::create(12, 1000);

        $this->assertTrue($validator->run($application1));
        $this->assertTrue($validator->run($application2));
    }

    public function testAllowedTermsExtensionAgainstOutOfBoundValue()
    {
        $validator = new Validator(
            new AllowedValuesValidatorExtension([12, 24])
        );
        $application = LoanProposal::create(48, 2500);

        $this->assertFalse($validator->run($application));
    }

    public function testAllowedTermsExtensionCorrectValue()
    {
        $validator = new Validator(
            new AllowedValuesValidatorExtension([12, 24])
        );
        $application1 = LoanProposal::create(12, 1000);
        $application2 = LoanProposal::create(24, 2000);

        $this->assertTrue($validator->run($application1));
        $this->assertTrue($validator->run($application2));
    }
}