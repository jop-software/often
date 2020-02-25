<?php

namespace App\Controller;

use App\Entity\User;
use App\Models\EntryModel;

class DashboardController extends BaseController
{

    public function indexAction() {

        // check if the user is logged and load only entry from the user
        if ($userid = $this->f3->get("SESSION.userid")) {
            $entries = (new EntryModel())->loadAllFromUser($userid);
        } else $entries = [];


        // add all total diff seconds from all loaded entries
        $totalSeconds = 0;
        if (isset($entries)) {
            foreach ($entries as $entry) {
                $totalSeconds += $entry->getWorktimeDifference()[2];
            } 
        }

        // convert seconds to hours and minutes
        $minutes = ($totalSeconds / (60)) % 60;
        $hours = ($totalSeconds / (60 * 60)) % 24;

        // format hours and minutes
        $hours = $hours <= 9
            ? $hours < 0 
                ? str_split($hours)[0] . "0" . str_split($hours)[1] 
                : "0$hours" 
            : $hours;

        $minutes = $minutes <= 9 
            ? "0$minutes" 
            : $minutes;

        if ($this->f3->get("SESSION.userid")) {
            $user = new User();
            $user->setId($this->f3->get("SESSION.userid"));
            $user->tryConstruct();
        }

        echo $this->render("dashboard/index.html.php", [
            "username" => isset($user) ? $user->getUsername() : "",
            "entries" => $entries,
            "totalSeconds" => $totalSeconds,
            "totalTime" => "$hours:$minutes"
        ]);
    }

}