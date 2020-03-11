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

        // inject the month names into the $months array
        foreach ($months as $index => $month) {
            $months[$index]["name"] = MonthConverterService::instance()->getName($month["month"]);
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

        echo $this->render("overview/month.html.php", [
            "year" => $year,
            "month" => $month,
            "monthname" => $monthName,
            "entries" => $entries["entries"],
            "hours" => $entries["hours"],
            "minutes" => $entries["minutes"]
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

        return [
            "hours" => $hours,
            "minutes" => $minutes,
            "entries" => $entries
        ];
    }

}