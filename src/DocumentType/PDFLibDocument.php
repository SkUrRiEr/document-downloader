<?php namespace DocDownloader\DocumentType;

use PDFLib\PDFLib;
use DocDownloader\Interfaces\DocumentType;

abstract class PDFLibDocument extends PDFLib implements DocumentType
{
    /**
     * @var bool
     */
    private $name;

    /**
     * @var string
     */
    private $message;

    private $listeners;

    public function __construct($orientation = "P", $unit = "mm", $format = "A4")
    {
        parent::__construct($orientation, $unit, $format);

        $this->name    = false;
        $this->message = "No reason specified.";
    }

    /**
     * @param string $name
     */
    protected function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return bool|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $message
     */
    protected function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param $args
     *
     * @return null
     */
    public function getETag($args)
    {
        return null;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return "application/pdf";
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return "pdf";
    }

    public function getContent()
    {
        return $this->Output(null, "S");
    }

    public function onHeader()
    {
    }

    public function onFooter()
    {
    }

    public function Footer()
    {
        parent::Footer();

        $this->onFooter();
    }

    public function Header()
    {
        parent::Header();

        $this->onHeader();
    }
}
