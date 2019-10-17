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
     * todo: do we need this or should we just log the user out on GET /logout?
     */
    public function logoutAction() {
        echo $this->render("user/logout.html.php");
    }

}