<?php namespace DocDownloader;

class FallbackDocument extends BaseDocument
{
    /**
     * FallbackDocument constructor.
     *
     * @param \DocDownloader\Interfaces\DocumentType $classname
     * @param                                 $document
     */
    public function __construct($classname, $document)
    {
        parent::__construct($document);

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
