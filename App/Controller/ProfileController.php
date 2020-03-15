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

    /**
     * POST /user/update/settings
     */
    public function updateSettings()
    {
        // we dont have any settings implemted yet, so we just reroute back to the profile
        $this->f3->reroute("/profile");
    }

    /**
     * POST /user/password/reset
     */
    public function resetPassword()
    {
        $form = $this->f3->clean($this->f3->get("POST"));

        // load the currently logged in user
        $userModel = new UserModel();
        $user = $userModel->getUserFromId(SessionWrapper::getUserId());

        // construct the user
        $user->tryConstruct();
        $user->setPassword($form["old_password"]);

        // check if the current password is valid for the user
        if ($userModel->checkCredentials($user)) {
            // check if the two new passwords are equal
            if ($form["new_password"] === $form["retype_password"]) {
                // set the new password
                if ($user->setPassword($form["new_password"])) {
                    $userModel->updateUser($user);
                    $this->message("Password erfolgreich geändert", "success");
                } else {
                    $this->error("Das neue Passwort ist nicht gültig");
                }
            } else {
                $this->error("Die neuen Passwörter sind nicht gleich");
            }
        } else {
            $this->error("Falsches Password");
        }

        $this->f3->reroute("/profile");
    }

}