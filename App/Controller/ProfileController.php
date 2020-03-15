<?php

namespace App\Controller;

use App\Core\SessionWrapper;
use App\Models\UserModel;

class ProfileController extends BaseController {

    /**
     * GET /profile
     */
    public function showAction()
    {
        $userModel = new UserModel();
        $user = $userModel->getUserFromId(
            SessionWrapper::getUserId()
        );

        echo $this->render("profile/user.twig", [
            "user" => $user
        ]);
    }

}