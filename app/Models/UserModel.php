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

}