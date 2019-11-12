<?php

namespace App\Controller;

class OverviewController extends BaseController {

    public function indexAction()
    {
        echo $this->render("overview/index.html.php");
    }

}