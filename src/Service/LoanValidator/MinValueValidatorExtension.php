<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\LoanValidator;

use PragmaGoTech\Interview\Interface\ValidatorExtension as ValidatorExtensionInterface;
use PragmaGoTech\Interview\Model\LoanProposal;

class MinValueValidatorExtension implements ValidatorExtensionInterface
{
    public function __construct(private float $minValue)
    {
    }

    public function validate(LoanProposal $loanProposal): bool
    {
        if ($loanProposal->amount() < $this->minValue) {
            return false;
        }

        return true;
    }
}