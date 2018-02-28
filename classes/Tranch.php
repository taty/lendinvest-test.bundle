<?php

class Tranch
{
    private $percent;
    private $maxAvailable;
    private $currentSum = 0;

    function getCurrentSum()
    {
        return $this->currentSum;
    }

    function setCurrentSum($currentSum)
    {
        $this->currentSum += $currentSum;
    }

    public function setPercent($percent){
        $this->percent = $percent;
    }

    public function getPercent(){
        return $this->percent;
    }

    public function setMaxAvailable($maxAvailable){
        $this->maxAvailable = $maxAvailable;
    }

    public function getMaxAvailable(){
        return $this->maxAvailable;
    }
}