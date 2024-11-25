<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\LoanValidator;

use PragmaGoTech\Interview\Interface\ValidatorExtension as ValidatorExtensionInterface;
use PragmaGoTech\Interview\Model\LoanProposal;

class LoanAllowedTermsValidatorExtension implements ValidatorExtensionInterface
{
    public function __construct(private array $allowedValues)
    {
    }

    public function validate(LoanProposal $loanProposal): bool
    {
        if (in_array($loanProposal->term(), $this->allowedValues) !== true) {
            return false;
        }

        return true;
    }
}