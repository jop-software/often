<?php

namespace App\Controller;

use Base;

class EntryController extends BaseController {

    public function createAction() {
        echo "create entry";
    }

    public function editAction(Base $f3, array $params) {
        echo "edit entry";
    }

    public function deleteAction(Base $f3, array $params) {
        echo "delete entry";
    }

    public function showAction(Base $f3, array $params) {
        echo "show entry";
    }

}