<?php
// set the output content type as xml
header('Content-Type: text/xml');
// create the new XML document
$dom = new DOMDocument();

// create the root <response> element
$response = $dom->createElement('response');
$dom->appendChild($response);

// create the <books> element and append it as a child of <response>
$books = $dom->createElement('books');
$response->appendChild($books);

// create the title element for the book
$title = $dom->createElement('title');
$titleText = $dom->createTextNode
    ('Building Reponsive Web Applications with AJAX and PHP');
$title->appendChild($titleText);

// create the isbn element for the book
$isbn = $dom->createElement('isbn');
$isbnText = $dom->createTextNode('1-904811-82-5');
$isbn->appendChild($isbnText);

 
// create the <book> element 
$book = $dom->createElement('book');
$book->appendChild($title);
$book->appendChild($isbn);

// append <book> as a child of <books>
$books->appendChild($book);

// build the XML structure in a string variable
$xmlString = $dom->saveXML();
// output the XML string
echo $xmlString;
?>
