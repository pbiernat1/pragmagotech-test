<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\LoanValidator;

use PragmaGoTech\Interview\Interface\LoanProposalValidator as LoanProposalValidatorInterface;
use PragmaGoTech\Interview\Model\LoanProposal;

class LoanProposalValidator implements LoanProposalValidatorInterface
{
    private array $allowedValues = [12, 24];

    public function validate(LoanProposal $loanProposal): bool
    {
        return $this->validateTerm($loanProposal); // refactor
    }

    private function validateTerm(LoanProposal $loanProposal): bool
    {
        if (in_array($loanProposal->term(), $this->allowedValues) !== true) {
            return false;
        }

        return true;
    }
}