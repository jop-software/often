<?php

namespace App\Controller;

class UserController extends BaseController {

    /**
     * show the Auth dialog
     */
    public function authAction()
    {
        echo $this->render("auth/auth.twig");
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

        /**
     * Override from BaseController
     */
    public function beforeRoute()
    {
        // do nothing
        // => you can not be logged in if you want to login / register
    }

}