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

    /**
     * POST /udpate/user/data
     * 
     * interal update from the user data
     */
    public function updateProfileData()
    {
        $form = $this->f3->clean($this->f3->get("POST"));
        $userId = SessionWrapper::getUserId();

        $userModel = new UserModel();
        $user = $userModel->getUserFromId($userId);

        // check if the username does exist in the database before setting it
        if (!$userModel->doesUsernameExist($username = $form["username"])) {

            // set the new username in the Entity and update in the database
            $user->setUsername($username);
            $userModel->updateUser($user);
        } else {
            $this->error("Dieser Benutzername ist bereits vergeben");
        }

        $this->f3->reroute("/profile");
    }

}