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
        echo $this->render("overview/index.html.php",[
            "months" => $months
        ]);
    }

    public function monthAction($_, $params)
    {
        $params = $this->f3->clean($params);
        $month = $params["month"];
        $year = $params["year"];
        $monthName = MonthConverterService::instance()->getName($month);

        echo $this->render("overview/month.html.php", [
            "year" => $year,
            "month" => $month,
            "monthname" => $monthName
        ]);
        
    }

}