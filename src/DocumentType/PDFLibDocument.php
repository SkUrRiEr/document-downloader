<?php namespace DocDownloader\DocumentType;

use PDFLib\PDFLib;
use DocDownloader\Interfaces\DocumentType;
use DocDownloader\Interfaces\EventListener;

class PDFLibDocument extends PDFLib implements DocumentType
{
    private $listeners;

    public function __construct($orientation = "P", $unit = "mm", $format = "A4")
    {
        parent::__construct($orientation, $unit, $format);

        $this->listeners = array();
    }

    public function getContent()
    {
        return $this->Output(null, "S");
    }

    /**
     * @param EventListener $class
     */
    public function addListener(EventListener $class)
    {
        $this->listeners[] = $class;
    }

    public function Footer()
    {
        parent::Footer();

        foreach ($this->listeners as $l) {
            $l->onFooter();
        }
    }

    public function Header()
    {
        parent::Header();

        foreach ($this->listeners as $l) {
            $l->onHeader();
        }
    }
}
