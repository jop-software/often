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
     * Render a template with given parameters
     */
    public function render(string $templateName, array $params = []) {

        // Iterate over all given parameters and set them as F3 variables
        foreach ($params as $key => $value) {
            $this->f3->set($key, $value);
        }

        $this->f3->set("GUI.template", $templateName);
        return Template::instance()->render("base.html.php");
    }

}