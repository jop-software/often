<?php

namespace App\Controller;

use App\Models\EntryModel;

class DashboardController extends BaseController
{

    public function indexAction() {
        $entries = (new EntryModel())->loadAll();

        echo $this->render("dashboard/index.html.php", [
            "entries" => $entries
        ]);
    }

}