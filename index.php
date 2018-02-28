<?php

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

$loan = new Loan('01-10-2015', '15-11-2015');

$tranch1 = new Tranch();
$tranch1->setPercent(3);
$tranch1->setMaxAvailable('1000');
$tranch2 = new Tranch();
$tranch2->setPercent(6);
$tranch2->setMaxAvailable('1000');


$report = new Report('01-11-2015');

$inv1 = new Investor('Investor 1');
$inv1->setTranch($loan, $tranch1, 1000, '03-10-2015');

$inv2 = new Investor('Investor 2');
$inv2->setTranch($loan, $tranch1, 1, '10-10-2015');
//$inv2->setTranch($loan, $tranch1, 800, '10-10-2015');
//$inv2->setTranch($loan, $tranch2, 200, '10-10-2015');

$inv3 = new Investor('Investor 3');
$inv3->setTranch($loan, $tranch2, 500, '10-10-2015');

$inv4 = new Investor('Investor 4');
$inv4->setTranch($loan, $tranch2, 1100, '25-10-2015');

$report->attach($inv1);
$report->attach($inv2);
$report->attach($inv3);
$report->attach($inv4);

$report->generate();



