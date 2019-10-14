<?php

namespace App\Controller;

class DashboardController extends BaseController
{

    public function indexAction() {
        echo $this->render("dashboard/index.html.php");
    }

}