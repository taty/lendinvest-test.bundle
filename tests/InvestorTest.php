<?php

use PHPUnit\Framework\TestCase;

class InvestorTest extends TestCase
{

    public function setUp()
    {

    }

    public function testCalculateIncome()
    {
        $loan = new Loan('01-10-2015', '15-11-2015');

        $tranch1 = new Tranch();
        $tranch1->setPercent(3);
        $tranch1->setMaxAvailable('1000');

        $inv1 = new Investor('Investor 1');
        $inv1->setTranch($loan, $tranch1, 1000, '03-10-2015');

        $this->assertEquals(28.06, $inv1->calculateIncome('01-11-2015'));
    }
}