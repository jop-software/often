<?php

namespace App\Models;

use App\Entity\Entry;

class EntryModel extends BaseModel
{

    /**
     * Save the given Entry to the database
     * does create a new dataset in the database => do not use for updating!
     */
    public function save(Entry $entry)
    {
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
                "userid" => "?",
            ])
            ->setParameter(0, $entry->getDate())
            ->setParameter(1, $entry->getStart())
            ->setParameter(2, $entry->getEnd())
            ->setParameter(3, $entry->getBreak())
            ->setParameter(4, $entry->getExp())
            ->setParameter(5, $entry->getNote())
            ->setParameter(6, $entry->getUserId());

        // Execute the query
        $queryBuilder->execute();
    }

    /**
     * Loads an Entry by the given ID from the database
     * 
     * @param int $id
     * @return \App\Entity\Entry
     */
    public function loadById(int $id)
    {

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
    public function update(Entry $entry)
    {

        $queryBuilder = $this->getQueryBuilder()
            ->update("entry")
            ->set("date", "?")
            ->set("start", "?")
            ->set("end", "?")
            ->set("break", "?")
            ->set("exp", "?")
            ->set("note", "?")
            ->where("ID = ?")
            ->setParameter(0, $entry->getDate())
            ->setParameter(1, $entry->getStart())
            ->setParameter(2, $entry->getEnd())
            ->setParameter(3, $entry->getBreak())
            ->setParameter(4, $entry->getExp())
            ->setParameter(5, $entry->getNote())
            ->setParameter(6, $entry->getId());

        $queryBuilder->execute();
    }

    /**
     * Load all Entries from the database 
     * 
     * @return Entry[]
     */
    public function loadAllFromUser(int $userid)
    {
        $queryBuilder = $this->getQueryBuilder()
            ->select("*")
            ->from("entry")
            ->where("userid = ?")
            ->orderBy("date", "asc")
            ->setParameter(0, $userid);

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
    public function deleteById(int $id)
    {
        $queryBuilder = $this->getQueryBuilder()
            ->delete("entry")
            ->where("ID = ?")
            ->setParameter(0, $id);

        $queryBuilder->execute();
    }

    public function loadMonthsFromUser(int $userid)
    {
        $queryBuilder = $this->getQueryBuilder()
            ->select("month(date) as month, year(date) as year")
            ->from("entry")
            ->where("userid = ?")
            ->groupBy("month, year")
            ->setParameter(0, $userid);

        $result = $queryBuilder->execute();

        if ($result->rowCount() >= 1) {
            $result = $result->fetchAll();

            // make sure to return array
            if (!is_array($result)) {
                return [$result];
            } else {
                return $result;
            }
        }
    }

    public function loadEntriesFromUserInMonthAndYear(int $userId, string $month, string $year)
    {
        $queryBuilder = $this->getQueryBuilder()
            ->select("*")
            ->from("entry")
            ->where("userid = ?")
            ->andWhere("year(entry.date) = ?")
            ->andWhere("month(entry.date) = ?")
            ->setParameter(0, $userId)
            ->setParameter(1, $year)
            ->setParameter(2, $month);

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
     * Delete all entries for the user with the given ID
     * 
     * @param string $userId
     */
    public function deleteAllFromUser(string $userId)
    {
        $queryBuilder = $this->getQueryBuilder()
            ->delete("entry")
            ->where("userid = ?")
            ->setParameter(0, $userId);
        
        $queryBuilder->execute();
    }

    /**
     * creates a App\Entity\Entry instance with the data from the given result
     * returns an array of instances if $result has two dimension
     * 
     * @param array $result
     * @return \App\Entity\Entry | \App\Entity\Entry[]
     */
    private function createEntryFromResult(array $result)
    {
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
    private function createSingleInstance(array $data)
    {
        $entry = new Entry();
        $entry->setId($data["ID"]);
        $entry->setDate($data["date"]);
        $entry->setStart($data["start"]);
        $entry->setEnd($data["end"]);
        $entry->setBreak($data["break"]);
        $entry->setExp($data["exp"]);
        $entry->setNote($data["note"]);
        $entry->setUserId($data["userid"]);

        return $entry;
    }
}
