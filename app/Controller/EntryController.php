<?php

namespace App\Controller;

use Base;

class EntryController extends BaseController {

    public function createAction() {
        echo $this->render("dashboard/create.html.php");
    }

    public function create(Base $f3, array $params) {
        $date = $this->f3->get("POST.date");
        $start = $this->f3->get("POST.start");
        $end = $this->f3->get("POST.end");
        $exp = $this->f3->get("POST.exp");
        $note = $this->f3->get("POST.note");

    }

    public function editAction(Base $f3, array $params) {
        $id = $params['id'];
        echo "edit entry $id";
    }

    public function deleteAction(Base $f3, array $params) {
        $id = $params['id'];
        echo "delete entry $id";
    }

    public function showAction(Base $f3, array $params) {
        $id = $params['id'];
        echo "show entry $id";
    }

}