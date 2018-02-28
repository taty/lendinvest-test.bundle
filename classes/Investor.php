<?php

/**
 * Investor class.
 *
 * @author Vakulenko Tatiana <tvakulenko@gmail.com>
 * @package packageName
 * @since 1.0
 *
 */
class Investor implements SplObserver
{
    /**
    * Description of name variable.
    *
    * @var string name.
    */
    private $name;
    /**
     * Description of incomePerDay variable.
     *
     * @var string $incomePerDay.
     */
    private $incomePerDay;
    /**
     * Description of fromDate variable.
     *
     * @var string $fromDate.
     */
    private $fromDate;
    /**
     * Description of virtWallet variable.
     *
     * @var string $virtWallet.
     */
    private $virtWallet = 1000;
    /**
     * Description of error variable.
     *
     * @var string $error.
     */
    private $error = "";


    /**
     * Function
     *
     * @param object $name
     *
     * @return
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Function update.
     *
     * @param object $subject
     *
     * @return
     */
    public function update(\SplSubject $subject)
    {
        if ($this->error == "")
        {
            echo $this->name . " - " . $this->calculateIncome($subject->getReportDate()) . "\n";
        } else {
            throw new Exception($this->name . " - " . $this->error);
        }
    }


    /**
     * Invest in a tranche if loan is open
     *
     * @param object $loan Loan
     * @param object $tranch Tranch
     * @param integer $investSum
     * @param string $fromDate
     *
     * @return
     */
    public function setTranch(Loan $loan, Tranch $tranch, $investSum, $fromDate)
    {
        $tranchSum = $tranch->getMaxAvailable() - $tranch->getCurrentSum();
        if($tranch->getMaxAvailable() == $tranch->getCurrentSum() || $tranchSum < $investSum){
            $this->error = "Further investments can't be made in that tranche";
            return;
        }

        if (strtotime($loan->getStartDate()) <= strtotime($fromDate) && strtotime($fromDate) <= strtotime($loan->getEndDate()))
        {
            $this->fromDate = $fromDate;
            $daysInMonth = $this->defineDayInMonth($loan->getStartDate());
            $tranch->setCurrentSum($investSum);

            if ($this->virtWallet >= $investSum)
            {
                $this->virtWallet -= $investSum;
            } else {
                $this->error = "You haven't enough money in your virtual wallet";
                return;
            }

            $sum = $investSum * $tranch->getPercent() /100 / $daysInMonth;
            $this->incomePerDay = number_format($sum, 4);
        } else {
            $this->error = "Wrong start period of tranche";
        }
    }

    /**
     * Define count of days in a month
     *
     * @param string $date
     *
     * @return
     */
    public function defineDayInMonth($date)
    {
        $month = date("m", strtotime($date));
        $year = date("Y", strtotime($date));
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }

    /**
     * Calculate income for the report
     *
     * @param string $reportDate
     *
     * @return
     */
    public function calculateIncome($reportDate)
    {
        $start = strtotime($this->fromDate);
        $end = strtotime($reportDate);
        $daysBetween = ceil(abs($end - $start) / 86400);
        $result = $this->incomePerDay * $daysBetween;

        return number_format($result, 2);
    }


}