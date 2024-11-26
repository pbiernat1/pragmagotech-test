<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Interface;

use PragmaGoTech\Interview\Model\LoanProposal;

interface ValidatorInterface
{
    public function run(LoanProposal $loanProposal): bool;
}
