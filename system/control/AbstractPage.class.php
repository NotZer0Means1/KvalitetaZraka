<?php
// open closed princip
include 'system/model/CityModel.class.php';
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

    public function printJSON($data)
    {
        return json_encode($data);
    }

    public function printXML($data)
    {

    }
}

?>