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
    
}