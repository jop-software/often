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

        $queryBuilder = $this->getQueryBuilder()
            ->select("*")
            ->from("entry")
            ->where("ID = ?")
            ->setParameter(0, $id);

        $result = $queryBuilder->execute();

        if ($result->rowCount() >= 1) {

            // get the data form the result
            $result = $result->fetchAll();
            
            // create and return an new entry instance with the result
            return $this->createEntryFromResult($result);
        }
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
        $queryBuilder = $this->getQueryBuilder()
            ->select("*")
            ->from("entry");

        $result = $queryBuilder->execute();

        if ($result->rowCount() >= 1) {
            // get the data form the result
            $result = $result->fetchAll();

            // create and return an new entry instance with the result
            $entries =  $this->createEntryFromResult($result);

            // make sure to return an array
            if (!is_array($entries)) {
                return [$entries];
            } else {
                return $entries;
            }
        }
        
    
    }

    /**
     * delete the entry with the given id from the database
     */
    public function deleteById(int $id) {
        $queryBuilder = $this->getQueryBuilder()
            ->delete("entry")
            ->where("ID = ?")
            ->setParameter(0, $id);

        $queryBuilder->execute();
    }

    /**
     * creates a App\Entity\Entry instance with the data from the given result
     * returns an array of instances if $result has two dimension
     * 
     * @param array $result
     * @return \App\Entity\Entry | \App\Entity\Entry[]
     */
    private function createEntryFromResult(array $result) {
        // check if the first element in the given array is an array
        // => if so, we have to return an array of instances
        // => if not, we can create a single instace from the array
        if (count($result) === 1) {
            // we have to construct only one array
            return $this->createSingleInstance($result[0]);
        } else {
            // create empty array to later store created instances
            $entires = [];
            // Iteate over all given entry data
            foreach ($result as $entryData) {
                // create a new entry instance and push to array
                array_push($entires, $this->createSingleInstance($entryData));
            }

            return $entires;
        }
    }

    /**
     * Create a single instance from the given data
     * only for use inside createEntryFromResult function
     * 
     * @param array $data
     * @return \App\Entity\Entry
     */
    private function createSingleInstance(array $data) {
        $entry = new Entry();
        $entry->setId($data["ID"]);
        $entry->setDate($data["date"]);
        $entry->setStart($data["start"]);
        $entry->setEnd($data["end"]);
        $entry->setBreak($data["break"]);
        $entry->setExp($data["exp"]);
        $entry->setNote($data["note"]);

        return $entry;
    }

}