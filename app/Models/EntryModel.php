<?php

namespace App\Models;

use App\Entity\Entry;

class EntryModel extends BaseModel {

    /**
     * Save the given Entry to the database
     * does create a new dataset in the database => do not use for updating!
     */
    public function save(Entry $entry) {
        // Construct the queryBuilder
        $queryBuilder = $this->getQueryBuilder()
            ->insert("entry")
            ->values([
                "date" => "?",
                "start" => "?",
                "end" => "?",
                "break" => "?",
                "exp" => "?",
                "note" => "?",
            ])
            ->setParameter(0, $entry->getDate())
            ->setParameter(1, $entry->getStart())
            ->setParameter(2, $entry->getEnd())
            ->setParameter(3, $entry->getBreak())
            ->setParameter(4, $entry->getExp())
            ->setParameter(5, $entry->getNote());

        // Execute the query
        $queryBuilder->execute();
    }

    /**
     * Loads an Entry by the given ID from the database
     * 
     * @param int $id
     * @return App\Entity\Entry
     */
    public function loadById(int $id) {
        $mapper = $this->getMapper("entry");

        $mapper->load(["ID = ?", $id]);

        $entry = new Entry();

        $entry->setId($mapper->ID);
        $entry->setDate($mapper->date);
        $entry->setStart($mapper->start);
        $entry->setEnd($mapper->end);
        $entry->setBreak($mapper->break);
        $entry->setExp($mapper->exp);
        $entry->setNote($mapper->note);

        return $entry;
    }

    /**
     * Update an given Entry in the database
     * uses the ID of the given entry to load the database object, so updating the ID of an Entry is possible
     * 
     * @param Entry $entry
     * @return bool
     */
    public function update(Entry $entry) {
        $mapper = $this->getMapper("entry");

        $mapper->load(["ID = ?", $entry->getId()]);

        $mapper->date = $entry->getDate();
        $mapper->start = $entry->getStart();
        $mapper->end = $entry->getEnd();
        $mapper->break = $entry->getBreak();
        $mapper->exp = $entry->getExp();
        $mapper->note = $entry->getNote();

        return $mapper->update();
    }

    /**
     * Load all Entries from the database 
     * 
     * @return array[Entry]
     */
    public function loadAll() {
        $mapper = $this->getMapper("entry");

        $entries = [];

        foreach ($mapper->find() as $dbEntry) {
            $entry = new Entry();

            $entry->setId($dbEntry->ID);
            $entry->setDate($dbEntry->date);
            $entry->setStart($dbEntry->start);
            $entry->setEnd($dbEntry->end);
            $entry->setBreak($dbEntry->break);
            $entry->setExp($dbEntry->exp);
            $entry->setNote($dbEntry->note);

            array_push($entries, $entry);
        }

        return $entries;
    }

    /**
     * delete the entry with the given id from the database
     */
    public function deleteById(int $id) {
        $mapper = $this->getMapper("entry");

        $mapper->load(["ID = ?", $id]);

        $mapper->erase();
    }

}