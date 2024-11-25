<?php

if (!file_exists('vendor/autoload.php')) {
    echo 'Run composer install first!';
    exit;
}

require_once 'vendor/autoload.php';

use PragmaGoTech\Interview\Model\LoanProposal;
use PragmaGoTech\Interview\Service\FeeCalculator\FeeCalculator;
use PragmaGoTech\Interview\Service\LoanValidator\LoanProposalValidator;

try {
    $validator = new LoanProposalValidator();
    $calculator = FeeCalculator::create($validator);

    $application = LoanProposal::create(12, 2750);
    $fee = $calculator->calculate($application);

    dump($fee);

    $application = LoanProposal::create(24, 2750);
    $fee = $calculator->calculate($application);

    dump($fee);

    $application = LoanProposal::create(25, 2750);
    $fee = $calculator->calculate($application);

    dump($fee);
}
catch(\Exception $e) {
    echo 'Runtime error: '. get_class($e) .' on '. $e->getFile() .':'. $e->getLine();
}
