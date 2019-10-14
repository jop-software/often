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
     * Render a template
     */
    public function render(string $templateName) {
        return Template::instance()->render($templateName);
    }

}