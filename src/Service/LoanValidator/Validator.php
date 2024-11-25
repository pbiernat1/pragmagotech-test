<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\LoanValidator;

use PragmaGoTech\Interview\Interface\Validator as ValidatorInterface;
use PragmaGoTech\Interview\Interface\ValidatorExtension;
use PragmaGoTech\Interview\Model\LoanProposal;

class Validator implements ValidatorInterface
{
    private $extensions = [];

    public function __construct(ValidatorExtension ...$extensions)
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