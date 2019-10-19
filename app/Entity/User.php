<?php

namespace App\Entity;

use App\Models\UserModel;

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

    /**
     * tries to load the userid (not the password)
     * 
     * @return bool
     */
    public function tryConstruct() {
        $userModel = new UserModel();
        $user = new User();

        $success = false;

        if (!$this->getId() && $this->getUsername()) {
            $user = $userModel->getUserFromUsername($this->getUsername());
            $success = true;
        } else if ($this->getId() && !$this->getUsername()) {
            $user = $userModel->getUserFromId($this->getId());
            $success = true;
        }

        if ($success) {
            $this->username = $user->getUsername();
            $this->id = $user->getId();
            return true;
        } else return false;
    }

    /**
     * check if the username exists in the database
     * 
     * @return bool
     */
    public function usernameExistsInDB() {
        $model = new UserModel();
        return $model->doesUsernameExist($this->username);
    }
}