<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\LoanValidator;

use PragmaGoTech\Interview\Interface\ValidatorExtension as ValidatorExtensionInterface;
use PragmaGoTech\Interview\Model\LoanProposal;

class MaxValueValidatorExtension implements ValidatorExtensionInterface
{
    private int $maxAmountValue = 20000; // PLN

    public function __construct(private float $maxValue)
    {
    }

    public function validate(LoanProposal $loanProposal): bool
    {
        if ($loanProposal->amount() > $this->maxValue) {
            return false;
        }

        return true;
    }
}