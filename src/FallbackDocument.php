<?php namespace DocDownloader;

use DocDownloader\Interfaces\DocumentType;

class FallbackDocument implements DocumentType
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
    }

    public function getName()
    {
        return "fallback";
    }

    public function getMessage()
    {
        return $this->classname." is not implemented.";
    }

    public function getMimeType()
    {
        return "text/html";
    }

    public function getExtension()
    {
        return "html";
    }

    public function getETag($args)
    {
        return null;
    }

    public function getContent()
    {
        return str_replace("{{{CLASSNAME}}}", $this->classname, file_get_contents(__DIR__."/fallback.html"));
    }

    /**
     * @param $args
     *
     * @return null
     */
    public function display($args)
    {
        return true;
    }
}
