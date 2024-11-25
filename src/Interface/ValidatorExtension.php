<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Interface;

use PragmaGoTech\Interview\Model\LoanProposal;

interface ValidatorExtension
{
    public function validate(LoanProposal $loanProposal): bool;
}
