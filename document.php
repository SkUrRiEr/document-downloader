<?php

require __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_cache_limiter("private_no_expire");

use DocDownloader\Interfaces\DocumentType;
use DocDownloader\FallbackDocument;
use DocDownloader\DocumentType\PDFLibDocument;

$items = array();

if (isset($_SERVER["PATH_INFO"]) && $_SERVER["PATH_INFO"] != "") {
    $path = preg_replace("/^\//", "", $_SERVER["PATH_INFO"]);

    if (preg_match("/^(.*)\.(.*?)$/", $path, $regs)) {
        $path = $regs[1];
    }

    $items = explode("/", $path);
}

$args = array();
for ($i = 1; $i < count($items); $i++) {
    $args[] = $items[$i];
}

$className = null;
$document = null;

if (count($items) > 0) {
    $className = ucfirst(current($items));
}

$namespacedClassName = "DocDownloader\\Document\\{$className}Document";

if ($className != null && class_exists($namespacedClassName)) {
    $document = new $namespacedClassName();
}

if (! is_subclass_of($document, DocumentType::class)) {
    $document = new FallbackDocument($className);
}

if ($_SERVER["HTTP_USER_AGENT"] == "contype") {
        header("Content-Type: ".$document->getMimeType());

        exit;
}

$etag = $document->getETag($args);

if ($etag != null) {
    header("ETag: \"".$etag."\"");
}

$ret = $document->display($args);

if ($ret != null && $ret != false) {
    $name = $document->getName();

    if (!$name) {
        $ret = $name;
    }
}

if ($ret === null) {
    $content = "<html><head><title>PDF Page</title></head><body><h1>Document Not Found</h1><h2>Error Message:</h2><p>".$document->getMessage()."</p></body></html>";

    header("HTTP/1.1 404 Page Not Found");
} elseif ($ret === false) {
    $content = "<html><head><title>Document Generation Failed</title></head><body><h1>PDF Generation Failed</h1><h2>Error Message:</h2><p>".$document->getMessage()."</p></body></html>";

    header("HTTP/1.1 500 Server Error");
} else {
    header("Content-Type: ".$document->getMimeType());

    $content = $document->getContent();

    header("Content-Disposition: inline; filename=".$name.".".$document->getExtension().";");
    header("Content-Length: ".strlen($content));
}

print $content;
