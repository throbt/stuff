<?php

/*
  Examle usage
*/
// class xmlStreamer extends xmlStreamParser {
//   public function doJob($xmlArray) {
// 		do somethin here...
//     	print_r($xmlArray);
//   }
// }

// $streamer = new xmlStreamer('example.xml','ENTRY',array(
//   'G:ID',
//   'TITLE',
//   'LINK',
//   'G:PRICE',
//   'DESCRIPTION',
//   'G:BRAND',
//   'G:MPN',
//   'G:IMAGE_LINK',
//   'G:PRODUCT_TYPE',
//   'G:AVAILABILITY',
//   'G:GOOGLE_PRODUCT_CATEGORY',
//   'G:MANUFACTURER',
//   'G:SIZE',
//   'G:FEATURE',
//   'C:GENDER',
//   'C:DIFFICULTY',
//   'C:CATEGORY',
//   'C:USERRATING',
//   'C:ISNEW',
//   'G:CONDITION'
// ));


/*
  simple xml parser with SAX
*/
abstract class xmlStreamParser {
  
  public $state = '';
  public $current;
  public $currentTag;
  public $currentTagState;
  
  public function __construct($file, $rootElement, $childs = array()) {
    $this->file       = $file;
    $this->xml_parser = xml_parser_create();
    $this->childs     = $childs;
    $this->rootEl     = $rootElement;
    xml_set_element_handler($this->xml_parser, array (&$this, 'startTag'), array (&$this, 'endTag'));
    xml_set_character_data_handler($this->xml_parser, array (&$this, 'contents'));
    $this->xmlOpen();
    xml_parser_free($this->xml_parser);
  }
  
  /*
    Gets called for every XML node that matched with $rootElement
    @param $xmlArray array
  */
  abstract public function doJob($xmlArray);
  
  
  
  public function xmlOpen() {
    $this->fp = fopen($this->file, 'r');
    while ($data = fread($this->fp, 1024)) {
      xml_parse($this->xml_parser, $data, feof($this->fp));
    }
    fclose($this->fp);
  }
  
  public function startTag($parser, $tag){
    if($tag == $this->rootEl) {
      $this->state = 'started';
      $this->current = array();
    } else if($tag != $this->rootEl && $this->state == 'started') {
      if (in_array($tag, $this->childs)) {
        $this->currentTagState  = 'open';
        $this->currentTag       = $tag;
      }
    }
  }
  
  public function endTag($parser, $tag){
    if($tag == $this->rootEl) {
      $this->state = 'ended';
      
      /*
        rootElement is at the end, abstract method doJob gets the current xml part
      */
      $this->doJob($this->current);
    } else if($tag != $this->rootEl && $this->state == 'started') {
      if (in_array($tag, $this->childs)) {
        $this->currentTagState  = 'closed';
      }
    }
  }
  
  public function contents($parser, $data){
    if (in_array($this->currentTag, $this->childs) && $this->currentTagState == 'open') {
      if(isset($this->current[$this->currentTag])) {
        if(getType($this->current[$this->currentTag]) == 'array') {
          $this->current[$this->currentTag][] = $data;
        } else {
          $arr = array();
          $arr[] = $this->current[$this->currentTag];
          $arr[] = $data;
          $this->current[$this->currentTag] = $arr;
        }
      } else {
        $this->current[$this->currentTag] = $data;
      }
    }
  }
}