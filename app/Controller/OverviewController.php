<?php

namespace App\Controller;

use App\Models\EntryModel;

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
        echo $params["month"];
    }

}