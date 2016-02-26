<?php namespace DocDownloader\DocumentType;

use DocDownloader\Interfaces\DocumentType;

abstract class HTMLDocument implements DocumentType
{
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

    public function getMimeType()
    {
        return "text/html";
    }

    public function getExtension()
    {
        return "html";
    }
}
