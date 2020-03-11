<?php

namespace App\Controller;

use App\Models\EntryModel;
use App\Services\MonthConverterService;

class OverviewController extends BaseController {

    public function indexAction()
    {
        $userId = $this->f3->get("SESSION.userid");
        $model = new EntryModel();
        $months = $model->loadMonthsFromUser($userId);

        // if $months = null => there are no entries
        if (!$months) {
            // reroute to dashboard
            // TODO: show info to user
            $this->f3->reroute("/dashboard");
        }

        // inject the month names into the $months array
        foreach ($months as $index => $month) {
            $months[$index]["name"] = MonthConverterService::instance()->getName($month["month"]);

            $entries = $this->getEntriesInMonth($userId, $month["year"], $month["month"]);
            $months[$index]["hours"] = $entries["hours"];
            $months[$index]["minutes"] = $entries["minutes"];
            $months[$index]["flag"] = $entries["flag"];
        }

        echo $this->renderTwig("overview/total.twig",[
            "months" => $months
        ]);
    }

    public function monthAction($_, $params)
    {
        $userId = $this->f3->get("SESSION.userid");
        $params = $this->f3->clean($params);
        $month = $params["month"];
        $year = $params["year"];
        $monthName = MonthConverterService::instance()->getName($month);
        $entries = $this->getEntriesInMonth($userId, $year, $month);

        echo $this->renderTwig("overview/month.twig", [
            "year" => $year,
            "month" => $month,
            "monthname" => $monthName,
            "entries" => $entries["entries"],
            "hours" => $entries["hours"],
            "minutes" => $entries["minutes"],
            "flag" => $entries["flag"]
        ]);
        
    }

    private function getEntriesInMonth(int $userId, string $year, string $month)
    {
        // load all entries in the given year / month
        $entries = (new EntryModel())->loadEntriesFromUserInMonthAndYear($userId, $month, $year);

        // add all total diff seconds from all loaded entries
        $totalSeconds = 0;
        if (isset($entries)) {
            foreach ($entries as $entry) {
                $difference = $entry->getWorktimeDifference();

                // check if the flag of the difference is a "-" and therefore add or subtract the seconds
                if ($difference["flag"] === "-") {
                    $totalSeconds -= $difference[2];
                } else {
                    $totalSeconds += $difference[2];
                }
            } 
        }

        // check if the total seconds are negative
        if ($totalSeconds < 0) {
            // if so, set the flag to "-"
            $flag = "-";
        }

        // we now have a flag wether the total seonds are negative or positive, to we can use the abs() value
        $totalSeconds = abs($totalSeconds);

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

        return [
            "hours" => $hours,
            "minutes" => $minutes,
            "entries" => $entries,
            "flag" => $flag
        ];
    }

}