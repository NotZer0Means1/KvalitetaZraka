<?php
// dependency inversion primjer
include_once 'system/model/CityModel.class.php';
include_once 'system/model/PurityModel.class.php';
abstract class AbstractPage
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
        include_once("system/view/{$template}.tpl.php");
    }

}

?>