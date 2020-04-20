<?php

namespace App\Controller;

use App\Core\SessionWrapper;
use App\Entity\User;
use App\Models\UserModel;
use Base;
use Exception;
use Prefab;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseController extends Prefab
{

    /**
     * @var Base
     */
    protected $f3;

    /**
     * BaseController constructor
     */
    public function __construct()
    {
        $this->f3 = Base::instance();

        if ($userid = $this->f3->get("SESSION.userid")) {
            $user = new User();
            $user->setId($userid);

            $user->tryConstruct();

            $language = $user->getLanguage();

            if (file_exists("app/config/languages/$language.cfg")) {
                $this->f3->config("app/config/languages/$language.cfg");
            }
        }
    }

    /**
     * call if you got an error
     * -> errors will get to the view
     */
    public function error(string $msg) 
    {
        // an error is an message type = danger
        $this->message($msg, "danger");
    }

    /**
     * Add a new message to the session
     * 
     * @param string $message
     * @param string $type
     * @return void
     */
    public function message(string $message, string $type) : void 
    {
        // add the message to the session using the sessionWrapper class
        SessionWrapper::addMessage($message, $type);
    }


    /**
     * return true if there are any errors
     * 
     * @deprecated
     */
    public function hasErrors() {
        return (bool)count($this->f3->get("SESSION.errors")) > 0;
    }

    /**
     * Render a TWIG-Template
     *
     * @param string $name name of the template
     * @param array $params all needed parameters for the template
     */
    public function render(string $name, array $params = array())
    {
        $loader = new FilesystemLoader($this->f3->get("twig.path"));
        $twig = new Environment($loader);

        $userModel = new UserModel();

        $params["base"] = $this->f3->get("BASE");
        $params["messages"] = SessionWrapper::getMessages();
        $params["customization"] = $this->f3->get("customization");

        if ($userId = $this->f3->get("SESSION.userid")) {
            $params["loggedin_user"] = $userModel->getUserFromId($this->f3->get("SESSION.userid"));
        }

        try {
            $html = $twig->render($name, $params);
        } catch (Exception $exception) {
            $this->f3->error(500, "Something went wrong, rendering the Template $name.<br>{$exception->getMessage()}");
        } finally {
            // clear the messages in every case
            SessionWrapper::clearMessages();
        }

        return $html;
    }

    /**
     * check if the user is logged in before routing
     */
    public function beforeRoute() {
        // check if there is a user id stored in the session
        if (!SessionWrapper::getUserId()) {
            // if there is no user id in the session, reroute to /auth
            $this->f3->reroute("/auth");
        } else {
            // check if the session is expired
            if (SessionWrapper::isExpired()) {
                // if so, reroute the user to /auth and set the user id in the session to null
                SessionWrapper::setUserId(null);
                $this->f3->reroute("/auth");
            } else {
                SessionWrapper::updateExpireDate();
            }
        }
    }

}