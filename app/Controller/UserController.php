<?php

namespace App\Controller;

class UserController extends BaseController {

    /**
     * loginAction
     * GET /login
     * 
     * render form, where the user can enter credentials and login
     */
    public function loginAction() {
        echo $this->render("user/login.html.php");
    }

    /**
     * registerAction
     * GET /register
     * 
     * render form for the user to register
     */
    public function registerAction() {
        echo $this->render("user/register.html.php");
    }

    /**
     * logoutAction
     * GET /logout
     * 
     * render form for the user to logout from their account
     */
    public function logoutAction() {
        // dont render any views, just call the AuthController and log the user out
        AuthController::instance()->logoutUser();
    }

}