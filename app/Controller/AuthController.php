<?php

namespace App\Controller;

use App\Entity\User;
use App\Models\UserModel;

class AuthController extends BaseController {

    public function loginUser() {

    }

    public function registerUser() {
        $username = $this->f3->get("POST.username");
        $password = $this->f3->get("POST.password");

        $user = new User();
        if (!$user->setUsername($username)) {
            $this->error("Username already exists");
        }

        if (!$user->setPassword($password)) {
            $this->error("Password is invalid");
        }

        // only create the user if we have no errors
        if (!$this->hasErrors()) {
            $userModel = new UserModel();
            $userModel->createNewUser($user);
        }

        $this->f3->reroute("/dashboard");
    }

    public function logoutUser() {

    }

}