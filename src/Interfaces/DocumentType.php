<?php namespace DocDownloader\Interfaces;

interface DocumentType
{
    /**
     * @return bool|string
     */
    public function getName();

    /**
     * @return string
     */
    public function getMessage();

    /**
     * @param $args
     *
     * @return null
     */
    public function getETag($args);

    /**
     * @param $args
     *
     * @return mixed
     */
    public function display($args);

    /**
     * @return string
     */
    public function getContent();
}
