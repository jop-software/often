<?php

namespace App\Entity;

class User {

    private $id;
    private $username;
    private $password;

    /**
     * set the id of the user
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * set the username of the user
     * 
     * @param string $username
     * @return bool
     */
    public function setUsername(string $username) {
        $this->username = $username;
    }

    /**
     * set the password of the user
     * returns false if the given password is invalid
     * 
     * @param string $password
     * @param bool $encrypt = true
     * @return bool
     */
    public function setPassword(string $password) {
        if (strlen($password) >= 8) {
            $this->password = sha1($password);
            return true;
        } else return false;
    }

    /**
     * get the id from the user
     */
    public function getId() {
        return $this->id;
    }

    /**
     * get the username from the user
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * get the password from the user˚
     */
    public function getPassword() {
        return $this->password;
    }
}