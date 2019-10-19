<?php

namespace App\Models;

use App\Entity\User;

class UserModel extends BaseModel {

    /**
     * check if the given username exists in the database
     */
    public function doesUsernameExist(string $username) {
        $queryBuilder = $this->getQueryBuilder()
            ->select("username")
            ->from("user")
            ->where("username = ?")
            ->setParameter(0, $username);

        $result = $queryBuilder->execute();

        return $result->rowCount() > 0;
    }

    /**
     * create a new user in the database
     * returns false if the user already exists
     * 
     * @return bool
     */
    public function createNewUser(User $user) {
        if ($this->doesUsernameExist($user->getUsername())) {
            return false;
        }

        $queryBuilder = $this->getQueryBuilder()
            ->insert("user")
            ->values([
                "username" => "?",
                "password" => "?",
            ])
            ->setParameter(0, $user->getUsername())
            ->setParameter(1, $user->getPassword());

        $queryBuilder->execute();
    }
    
    /**
     * get the password from the user with the given id from the database
     * 
     * @param User $user
     * @return string
     */
    private function getPasswordFromUser(User $user) {
        $queryBuilder = $this->getQueryBuilder()
            ->select("password")
            ->from("user")
            ->where("username = ?")
            ->setParameter(0, $user->getUsername());
        
        $result = $queryBuilder->execute();

        if ($result->rowCount() >= 1) {
            return $result->fetchAll()[0]["password"];
        } else return false;
    }

    /**
     * check if the password from the given user matches the password
     * stored in the database with the given username
     * 
     * @return bool
     */
    public function checkCredentials(User $user) {
        $password = $this->getPasswordFromUser($user);

        return $user->getPassword() === $password;
    }

}