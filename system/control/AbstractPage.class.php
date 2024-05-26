<?php

include 'IndexPage.class.php';

abstract class AbstaractPage
{
    protected $templateName;
    protected $data = [];

    public function __construct()
    {
        $this->execute();
        $this->show();
    }

    abstract function execute();

    public function show()
    {
        $template = $this->templateName;
        $data = $this->data;
        include_once('system/view/' . $template . '.tpl.php');
    }
}

?>