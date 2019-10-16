<?php

namespace App\Models;

use App\Entity\Entry;

class EntryModel extends BaseModel {

    public function save(Entry $entry) {
        $mapper = $this->getMapper("entry");

        $mapper->date = $entry->getDate();
        $mapper->start = $entry->getStart();
        $mapper->end = $entry->getEnd();
        $mapper->exp = $entry->getExp();
        $mapper->break = $entry->getBreak();
        $mapper->note = $entry->getNote();

        $mapper->save();
    }

    public function loadById(int $id) {

    }

    public function updateById(int $id) {

    }

    public function loadAll() {

    }

}