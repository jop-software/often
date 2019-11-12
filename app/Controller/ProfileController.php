<?php

namespace App\Controller;

class ProfileController extends BaseController {

    /**
     * GET /profile
     */
    public function showAction()
    {
        echo $this->render("profile/profile.html.php");
    }

}