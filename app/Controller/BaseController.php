<?php

namespace App\Controller;

use Base;
use Prefab;
use Template;

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
     * check if the user is logged in before routing
     */
    public function beforeRoute() {
        if (!$this->f3->get("SESSION.userid")) {
            $this->f3->reroute("/dashboard");
        }
    }

}