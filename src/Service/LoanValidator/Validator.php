<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\LoanValidator;

use PragmaGoTech\Interview\Interface\ValidatorInterface;
use PragmaGoTech\Interview\Interface\ValidatorExtensionInterface;
use PragmaGoTech\Interview\Model\LoanProposal;

class Validator implements ValidatorInterface
{
    private $extensions = [];

    public function __construct(ValidatorExtensionInterface ...$extensions)
    {
        $this->extensions = $extensions;
    }

    public function run(LoanProposal $loanProposal): bool
    {
        $isValid = true; //initial state, when no extensions are loaded

        foreach ($this->extensions as $extension) {
            $isValid = $extension->validate($loanProposal);
            
            if (!$isValid) {
                break;
            }

            continue;
        }

        return $isValid;
    }
}