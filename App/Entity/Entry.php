<?php

namespace App\Entity;

use DateInterval;
use DateTime;

class Entry {

    /// Variables, stored in database
    private $id;

    /**
     * @var \App\Entity\Time
     */
    private $date;

    private $start;
    private $end;
    private $break;
    private $exp;
    private $note;
    private $userid;

    /// Cached Variables
    private $workedTime;

    /// Basic Getter & Setter

    public function setId(int $id) {
        $this->id = $id;
    }

    /**
     * set the date of the entry
     */
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
        if ($break) {
            $this->break = $break;
        } else {
            $this->break = (new DateInterval("PT0S"))->format("%H:%I:%S");
        }
    }

    public function setExp($exp) {
        $this->exp = $exp;
    }
    
    public function setNote($note) {
        $this->note = $note;
    }

    public function setUserId($id) {
        $this->userid = $id;
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

    public function getUserId() {
        return $this->userid;
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

            $work = $start->diff($end)->format("%H:%i:%S");
            $work = new DateTime($work);

            //for what ever reason we need to add the break to the work
            $work->add($break->diff(new DateTime("00:00:00")));

            $this->workedTime = $work->format("H:i:s");
        }

        return $this->workedTime;
    }

    /**
     * calculate the work difference 
     * todo: does not calculate negative values
     * 
     * @return arary 
     */
    public function getWorktimeDifference() {
        // Get work time in millis
        $workedTime = new DateTime($this->getWorkedTime());
        $workedTime = $workedTime->getTimestamp();

        // Get exp work time in millis
        $exp = new DateTime($this->getExp());
        $exp = $exp->getTimestamp();

        // substract actual worked time from extected tme
        // $diff are seconds
        $diff = -($exp - $workedTime);

        // check if the difference is negative
        if ($diff < 0) {
            // if so, set the flag to "-"
            $flag = "-";
        }
        $diff = abs($diff);

        // work out hours and minutes
        $minutes = ($diff / (60)) % 60;
        $hours = ($diff / (60 * 60)) % 24;

        // prepare values for return
        $hours = $hours <= 9 
                ? $hours < 0 
                    ? str_split($hours)[0] . "0" . str_split($hours)[1] 
                    : "0$hours" 
                : $hours;

        $minutes = $minutes <= 9 
            ? "0$minutes" 
            : $minutes;

        // return the hours (with sign), minutes an total seconds
        // hours / minutes for rendering in views
        // total seconds (with sign) for further calculation
        return [
            $hours,
            $minutes,
            $diff,
            "print" => "$flag$hours:$minutes",
            "flag" => $flag
        ];
    }

}