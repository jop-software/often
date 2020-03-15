<?php

namespace App\Entity;

use DateTime;
use App\Models\UserModel;

class User {

    private $id;
    private $username;
    private $password;
    private $language;

    /**
     * @var DateTime
     */
    private $created_at;

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
     * set the language of the current user
     */
    public function setLanguage(string $language) {
        $this->language = $language;
    }

    /**
     * Set the datetime of the user
     * 
     * @param string $created_at
     */
    public function setCreatedAt(string $created_at)
    {
        // construct a new DateTime object and set it info $this->created_at
        $this->created_at = new DateTime($created_at);
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
     * gets the language of the current user 
     * 
     * @return string
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * get the creation date from the database
     *  
     * @param string $format DateTime->format() string
     * @return string 
     */
    public function getCreatedAt(string $format = "d.m.Y") : string
    {
        return $this->created_at->format($format);
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
            $this->language = $user->getLanguage();
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