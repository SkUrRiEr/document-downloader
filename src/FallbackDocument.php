<?php namespace DocDownloader;

use DocDownloader\DocumentType\HTMLDocument;

class FallbackDocument extends HTMLDocument
{
    private $classname;

    /**
     * FallbackDocument constructor.
     *
     * @param string $classname
     */
    public function __construct($classname)
    {
        $this->classname = $classname;
        $this->setName("fallback");
        $this->setMessage($classname." is not implemented.");
    }

    public function getContent()
    {
        return str_replace("{{{CLASSNAME}}}", $this->classname, file_get_contents(__DIR__."/fallback.html"));
    }

    public function display($args)
    {
        return true;
    }
}
