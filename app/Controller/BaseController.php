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
     * @var string[]
     */
    protected $errors = [];

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
        array_push($this->errors, $msg);
    }

    /**
     * clear the error array
     */
    public function clearErrors() {
        $this->errors = [];
    }

    /**
     * return true if there are any errors
     */
    public function hasErrors() {
        return (bool)count($this->errors) > 0;
    }

    /**
     * Render a template with given parameters
     */
    public function render(string $templateName, array $params = [], bool $clearErrors = true) {

        // Iterate over all given parameters and set them as F3 variables
        foreach ($params as $key => $value) {
            $this->f3->set($key, $value);
        }

        // pass the error array to the view
        $this->f3->set("errors", $this->errors);

        // clear the errors if the flag is set
        if ($clearErrors) $this->clearErrors();

        $this->f3->set("GUI.template", $templateName);
        return Template::instance()->render("base.html.php");
    }

}