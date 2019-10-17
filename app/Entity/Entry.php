<?php

namespace App\Entity;

use DateInterval;
use DateTime;

class Entry {

    /// Variables, stored in database
    private $id;
    private $date;
    private $start;
    private $end;
    private $break;
    private $exp;
    private $note;

    /// Cached Variables
    private $workedTime;

    /// Basic Getter & Setter

    public function setId(int $id) {
        $this->id = $id;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setStart($start) {
        $this->start = $start;
    }

    public function setEnd($end) {
        $this->end = $end;
    }

    public function setBreak($break) {
        $this->break = $break;
    }

    public function setExp($exp) {
        $this->exp = $exp;
    }
    
    public function setNote($note) {
        $this->note = $note;
    }

    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function getStart() {
        return $this->start;
    }

    public function getEnd() {
        return $this->end;
    }

    public function getBreak() {
        return $this->break;
    }

    public function getExp() {
        return $this->exp;
    }

    public function getNote() {
        return $this->note;
    }

    // Getter for calculated values

    /**
     * Get the worked time 
     */
    public function getWorkedTime() {
        if (!isset($this->workedTime)) {
            $start = new DateTime($this->start);
            $end = new DateTime($this->end);
            $break = new DateTime($this->break);

            $work = $start->diff($end)->format("%H:%I:%S");
            $work = new DateTime($work);

            //for what ever reason we need to add the break to the work
            $work->add($break->diff(new DateTime("00:00:00")));

            $this->workedTime = $work->format("H:I:s");
        }

        return $this->workedTime;
    }

    /**
     * calculate the work difference 
     * todo: does not calculate negative values
     */
    public function getWorktimeDifference() {
        // Get work time in millis
        $workedTime = new DateTime($this->getWorkedTime());
        $workedTime = $workedTime->getTimestamp();

        // Get exp work time in millis
        $exp = new DateTime($this->getExp());
        $exp = $exp->getTimestamp();

        // substract actual worked time from extected tme
        $diff = $exp - $workedTime;

        $overtime = (new DateTime())->setTimestamp($diff);
        return $overtime->format("H:I:s");
    }

}