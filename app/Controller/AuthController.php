<?php

namespace App\Controller;

use App\Entity\User;
use App\Models\UserModel;

class AuthController extends BaseController
{

    public function loginUser()
    {
        // Get the login data from the POST request
        $username = $this->f3->get("POST.username");
        $password = $this->f3->get("POST.password");

        // create the user with the data from the form
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);

        
        $model = new UserModel();
        if ($model->checkCredentials($user)) {
            $user->tryConstruct();
            $this->f3->set("SESSION.userid", $user->getId());
            $this->f3->reroute("/dashboard");
        } else {
            $this->f3->reroute("/login");
        }
    }

    public function registerUser()
    {
        $username = $this->f3->get("POST.username");
        $password = $this->f3->get("POST.password");

        $user = new User();
        if (!$user->setUsername($username)) {
            $this->error("Username <$username> already exists");
        }

        if (!$user->setPassword($password)) {
            $this->error("Password is invalid");
        }

        // only create the user if we have no errors
        if (!$this->hasErrors()) {
            $userModel = new UserModel();
            $userModel->createNewUser($user);
            $this->f3->reroute("/dashboard");
        } else {
            $this->f3->reroute("/register");
        }
    }

    public function logoutUser()
    { 
        $this->f3->set("SESSION.userid", "");
        $this->f3->reroute("/dashboard");
    }
}
