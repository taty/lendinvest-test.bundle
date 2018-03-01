<?php

use PHPUnit\Framework\TestCase;

class InvestorTest extends TestCase
{

    public function setUp()
    {

    }

    public function testCalculateIncomeOne()
    {
        $loan = new Loan('01-10-2015', '15-11-2015');

        $tranch1 = new Tranch();
        $tranch1->setPercent(3);
        $tranch1->setMaxAvailable('1000');

        $inv1 = new Investor('Investor 1');
        $inv1->setTranch($loan, $tranch1, 1000, '03-10-2015');

        $this->assertEquals(28.06, $inv1->calculateIncome('01-11-2015'));
    }

    public function testCalculateIncomeTwo()
    {
        $loan = new Loan('01-10-2015', '15-11-2015');

        $tranch2 = new Tranch();
        $tranch2->setPercent(6);
        $tranch2->setMaxAvailable('1000');

        $inv3 = new Investor('Investor 3');
        $inv3->setTranch($loan, $tranch2, 500, '10-10-2015');

        $this->assertEquals(21.29, $inv3->calculateIncome('01-11-2015'));
    }
}