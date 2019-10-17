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
     */
    public function setUsername(string $username) {
        $this->username = $username;
    }

    /**
     * set the password of the user
     * set $encrypt to false if you already have the hashed password
     * 
     * @param string $password
     * @param bool $encrypt = true
     */
    public function setPassword(string $password, bool $encrypt = true) {
        if ($encrypt) {
            $this->password = sha1($password);
        } else {
            $this->password = $password;
        }
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