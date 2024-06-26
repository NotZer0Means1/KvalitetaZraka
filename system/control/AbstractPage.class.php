<?php
// dependency injection with every class in this folder
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