<?php

namespace App\Controller;

use App\Entity\User;
use App\Models\UserModel;

class AuthController extends BaseController
{

    /**
     * internal handle for logging users in
     */
    public function loginUser()
    {
        // Get the login data from the POST request or the params if not null
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
        $user->setUsername($username);

        // check if the username already exists in database
        // todo: do we need this in Entry\User or should we create a new UserModel here and check?
        if ($user->usernameExistsInDB()) $this->error("Username <$username> already exists");

        if (!$user->setPassword($password)) {
            $this->error("Password is invalid");
        }

        // only create the user if we have no errors
        if (!$this->hasErrors()) {
            $userModel = new UserModel();
            $userModel->createNewUser($user);

            // log the user in
            $user->tryConstruct();
            $this->f3->set("SESSION.userid", $user->getId());

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

    /**
     * Override from BaseController
     */
    public function beforeRoute()
    {
        // do nothing
        // => we want the dashboard route available for everyone
    }
}
