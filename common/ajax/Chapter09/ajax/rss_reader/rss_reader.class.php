<?php
// this class retrieves an RSS feed and performs a XSLT transformation
class CRssReader
{
  private $mXml;
  private $mXsl;

  // Constructor - creates an XML object based on the specified feed
  function __construct($szFeed) 
  {
    // retrieve the RSS feed in a SimpleXML object
    $this->mXml = simplexml_load_file(urldecode($szFeed));
    // retrieve the XSL file contents in a SimpleXML object
    $this->mXsl = simplexml_load_file('rss_reader.xsl');
  }

  // Creates a formatted XML document based on retrieved feed
  public function getFormattedXML()
  {
    // create the XSLTProcessor object
    $proc = new XSLTProcessor;
    // attach the XSL
    $proc->importStyleSheet($this->mXsl); 
    // apply the transformation and return formatted data as XML string 
    return $proc->transformToXML($this->mXml);
  }
}
?>
