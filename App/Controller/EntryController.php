<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Models\EntryModel;
use Base;

class EntryController extends BaseController {

    public function createAction() {
        $this->f3->set("vars.date", date("Y-m-d"));
        echo $this->render("entry/new.twig", []);
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

        // check if the user is the owner of this entry
        $this->checkUser($this->f3->get("SESSION.userid"), $id);

        $entry = (new EntryModel())->loadById($id);

        echo $this->render("entry/edit.twig", [
            "entry" => $entry
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

        // check if the user is the owner of this entry
        $this->checkUser($this->f3->get("SESSION.userid"), $id);

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

        $user_id = $this->f3->get("SESSION.userid");

        $entry = (new EntryModel())->loadById($id);

        // check if the user owns the entry he wants to delete
        if ($entry->getUserId() === $user_id) {
            (new EntryModel())->deleteById($id);
        } else {
            // otherwies, reroute to dashboard
            $this->message("Dieser Eintrag gehört dir nicht, also darfst du ihn auch nicht löschen.", "info");
            $this->f3->reroute("/dashboard");
        }

        $this->f3->reroute("/dashboard");
    }

    public function showAction(Base $f3, array $params) {
        $id = $params["id"];

        // check if the user is the owner of this entry
        $this->checkUser($this->f3->get("SESSION.userid"), $id);

        $entry = (new EntryModel())->loadById($id);

        echo $this->render("entry/show.twig", [
            "entry" => $entry
        ]);
    }

    /**
     * check if the user is allowd to use this route
     * -> is the user the owner of the entry he wants to edit / show / delete?
     */
    private function checkUser(int $userid, int $entryid) {
        // load the entry with the given id from the database
        $entry = new Entry();
        $entryModel = new EntryModel();
        $entry = $entryModel->loadById($entryid);

        // check if the entry does exist
        if (!$entry) {
            // reroute the user to the create entry route when there is no entry with the given ID
            $this->f3->reroute("/entry/create");
        }

        // are the userid and the userid from the entry the same?
        if ($entry->getUserId() != $userid) {
            // reroute the user to the create entry form if he isnt allowd to use this entry
            $this->f3->reroute("/entry/create");
        } else return true;
    }

}