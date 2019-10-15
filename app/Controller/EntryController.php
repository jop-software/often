<?php

namespace App\Controller;

use Base;

class EntryController extends BaseController {

    public function createAction() {
        echo "create entry";
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