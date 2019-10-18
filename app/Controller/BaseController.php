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
        return Template::instance()->render("base.html.php");
    }

}