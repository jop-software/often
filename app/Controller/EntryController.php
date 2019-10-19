<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Models\EntryModel;
use Base;

class EntryController extends BaseController {

    public function createAction() {
        echo $this->render("entry/create.html.php");
    }

    public function create(Base $f3, array $params) {
        // Load values from form
        $date = $this->f3->get("POST.date");
        $start = $this->f3->get("POST.start");
        $end = $this->f3->get("POST.end");
        $break = $this->f3->get("POST.break");
        $exp = $this->f3->get("POST.exp");
        $note = $this->f3->get("POST.note");

        // create entry
        $entry = new Entry();
        $entry->setDate($date);
        $entry->setStart($start);
        $entry->setEnd($end);
        $entry->setBreak($break);
        $entry->setExp($exp);
        $entry->setNote($note);
        $entry->setUserId($this->f3->get("SESSION.userid"));

        // save entry to database

        $entryModel = new EntryModel();
        $entryModel->save($entry);
        
        // reroute to dashboard
        $this->f3->reroute("/dashboard");
    }

    public function editAction(Base $f3, array $params) {
        $id = $params['id'];
        $entry = (new EntryModel())->loadById($id);

        echo $this->render("entry/edit.html.php", [
            "entry" => $entry,
        ]); 
    }

    /**
     * API Handler for editing an entry in the databse POST /editEntry
     */
    public function edit() {
        $entry = new Entry();
        $entry->setId($this->f3->get("POST.id"));
        $entry->setDate($this->f3->get("POST.date"));
        $entry->setStart($this->f3->get("POST.start"));
        $entry->setEnd($this->f3->get("POST.end"));
        $entry->setBreak($this->f3->get("POST.break"));
        $entry->setExp($this->f3->get("POST.exp"));
        $entry->setNote($this->f3->get("POST.note"));

        (new EntryModel())->update($entry);

        $this->f3->reroute("/dashboard");
    }

    public function deleteAction(Base $f3, array $params) {
        $id = $params['id'];
        $entry = (new EntryModel())->loadById($id);

        echo $this->render("entry/delete.html.php", [
            "entry" => $entry,
        ]);
    }

    /**
     * API Route handler for deleting an entry
     */
    public function delete() {
        $id = $this->f3->get("POST.id");

        (new EntryModel())->deleteById($id);

        $this->f3->reroute("/dashboard");
    }

    public function showAction(Base $f3, array $params) {
        $id = $params["id"];
        $entry = (new EntryModel())->loadById($id);
        
        echo $this->render("entry/show.html.php", [
            "entry" => $entry,
        ]);
    }

}