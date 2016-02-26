# document-downloader
 Basic downloader for documents, e.g. PDFs

The goal of this project is to provide a basic downloader for documents which might be downloaded or viewed in a browser.

It's based on "pdf.php" and related libraries from pdflib at 96e6efb.

## document.php

document.php is the top-level file to download documents through. It uses the downloader class for most of it's functionality.

### Usage
document.php is called like:

`http://site/path/to/dir/document.php[/name][/params][.ext][?params=values...]`

(items in square brackets are optional)

The extension after the params is optional and will, if it exists, be stripped
out of the parameters.

Upon being called like so, document.php will attempt to instansiate the class
named `DocDownloader\Document\NameDocument`

If the class cannot be found, or the name is omitted, it will instead
instansiate the class `DocDownloader\Document\FallbackDocument` instead. This
class will be used as if it were the class for the named document. In this
case, the params as passed to `->display()` will be all path components
specified in the URL.

This class must implement `DocDownloader\Interfaces\DocumentType` class.

The `->display()` method of the selected class will be called with the params
as specified in the URL as an array as it's only parameter.

If the document is successfully generated, this method must return true. If
there is no data, it must return `null`, and if there is an error, it must
return `false`.

The `->getName()` method of the selected class will then be called with no
parameters.

This method will either return a string naming the document. (e.g. for a PDF
called `example.pdf`, this method will return `example`) `false` if there
is an error or `null` if there is no data.

If `->display()` or `->getName()` returns false, then a 500 class error page
will be generated with the string returned from `->getMessage()`. If either of
them return `null`, then a 404 page will be generated with the string from
`->getMessage()`. Otherwise, the `->Output()` method will be called on the class
to get the document data.

## Installation
The dependencies are stored in `composer.json`, so install composer (see https://getcomposer.org/ for instructions) then run:

```
composer install
```

## Contributing
All contributions must contain a signed-off-by line in accordance with the Developer Certificate of Origin: http://developercertificate.org/

All contributions must be licensed under the LGPL 2.1.

## Usage / API
`src/Document/ExampleDocument.php` is a basic test case and provides a good reference for how a pdf class should work.

It's output can be found by loading:

`http://site/path/to/dir/document.php/example.pdf`

in a browser.

The PDF file produced is also saved in the top directory as `example.pdf`.
