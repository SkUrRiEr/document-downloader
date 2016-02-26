<?php namespace DocDownloader;

use DocDownloader\DocumentType\PDFLibDocument;

class FallbackDocument extends PDFLibDocument
{
    /**
     * FallbackDocument constructor.
     *
     * @param string $classname
     */
    public function __construct($classname)
    {
        parent::__construct();

        $this->setMessage("Document class not defined");
    }

    /**
     * @param $args
     *
     * @return null
     */
    public function display($args)
    {
        return null;
    }
}
