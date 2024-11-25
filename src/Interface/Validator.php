<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Interface;

use PragmaGoTech\Interview\Model\LoanProposal;

interface Validator
{
    public function run(LoanProposal $loanProposal): bool;
}
