<?php

namespace App\Controller;

use App\Entity\User;
use Base;
use Prefab;
use Template;
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
    public function error(string $msg) {
        $errors = $this->f3->get("SESSION.errors");
        if (!$errors) $errors = [];
        array_push($errors, $msg);
        $this->f3->set("SESSION.errors", $errors);
    }

    /**
     * clear the error array
     */
    public function clearErrors() {
        $this->f3->set("SESSION.errors", []);
    }

    /**
     * return true if there are any errors
     */
    public function hasErrors() {
        return (bool)count($this->f3->get("SESSION.errors")) > 0;
    }

    /**
     * Render a template with given parameters
     *
     * @deprecated
     */
    public function render(string $templateName, array $params = [], bool $clearErrors = true) {

        // Iterate over all given parameters and set them as F3 variables
        foreach ($params as $key => $value) {
            $this->f3->set($key, $value);
        }

        $this->f3->set("GUI.template", $templateName);
        $template = Template::instance()->render("base.html.php");

        // we have to clear the errors after the render, but before the end
        // of this function

        // check if the $clearErrors flag is set
        // if so, call the clearErrors function
        if ($clearErrors) $this->clearErrors();

        return $template;
    }

    /**
     * Render a TWIG-Template
     *
     * @param string $name name of the template
     * @param array $params all needed parameters for the template
     */
    public function renderTwig(string $name, array $params)
    {
        $loader = new FilesystemLoader($this->f3->get("twig.path"));
        $twig = new Environment($loader);

        $params["base"] = $this->f3->get("BASE");

        return $twig->render($name, $params);
    }

    /**
     * check if the user is logged in before routing
     */
    public function beforeRoute() {
        // check if the user is logged in
        if (!$this->f3->get("SESSION.userid")) {
            $this->f3->reroute("/dashboard");
        }
    }

}