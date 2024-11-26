<?php

if (!file_exists('vendor/autoload.php')) {
    echo 'Run composer install first!';
    exit;
}

require_once 'vendor/autoload.php';

use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\FeeCalculator\FeeCalculator;
use PragmaGoTech\Interview\Service\LoanValidator\LoanAllowedTermsValidatorExtension;
use PragmaGoTech\Interview\Service\LoanValidator\LoanMaxAmountValidatorExtension;
use PragmaGoTech\Interview\Service\LoanValidator\LoanMinAmountValidatorExtension;
use PragmaGoTech\Interview\Service\LoanValidator\Validator;

try {
    $loanTermValidator = new Validator(
        new LoanAllowedTermsValidatorExtension([12, 24])
    );
    $loanAmountValidator = new Validator(
        new LoanMinAmountValidatorExtension(1000),
        new LoanMaxAmountValidatorExtension(20000)
    );
    $calculator = FeeCalculator::create($loanTermValidator, $loanAmountValidator);

    $application = LoanProposal::create(12, 19250);
    $fee = $calculator->calculate($application);

    dump($fee);

    $application = LoanProposal::create(24, 11500);
    $fee = $calculator->calculate($application);

    dump($fee);
}
catch(\Exception $e) {
    echo 'Runtime error: '. get_class($e) .' on '. $e->getFile() .':'. $e->getLine() . PHP_EOL;
    // dump($e->getTrace());
}
