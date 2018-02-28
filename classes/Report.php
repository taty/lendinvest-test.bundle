<?php

class Report implements \SplSubject{

    private $observers = array();
    private $reportDate;

    public function __construct($reportDate)
    {
        $this->reportDate = $reportDate;
    }

    public function attach(\SplObserver $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(\SplObserver $observer)
    {
        $key = array_search($observer,$this->observers, true);
        if($key){
            unset($this->observers[$key]);
        }
    }

    public function generate()
    {
        echo "Generate report\n";
        $this->notify();
    }

    public function getReportDate()
    {
        return $this->reportDate;
    }

    public function notify()
    {
        foreach ($this->observers as $value)
        {
            $value->update($this);
        }
    }


}
