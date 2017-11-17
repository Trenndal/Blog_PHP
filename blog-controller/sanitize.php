<?php

class Sanitize {
	private $datat;
	
	function __construct($text) {
		$this->datat=$text;
	}
	
	public function sanitizeText () {
		return addcslashes($this->datat, "%_'");
	}
	
	public function sanitizeHTML ($allowed_tags = array('title','p','html','body','div','br','a','h2','h3','h4','h5','span','img','b','i','q','pre','sub','sup','u'),$allowed_attributes = array('id','border','name','color','style','align','dir','src','href')) {
		$data=addcslashes($this->datat, "%_'");
		$libxml_previous_state = libxml_use_internal_errors(true); // Don't print errors
		
		$dom = new DOMDocument();
		if($dom->loadHTML($data)){
			$domElemsToRemove = array(); 
			foreach($dom->getElementsByTagName('*') as $node){
				if(!in_array($node->nodeName,$allowed_tags)) {
					$domElemsToRemove[] = $node;
					
				} else {
					for($i = $node->attributes->length -1; $i >= 0; $i--){
						$attribute = $node->attributes->item($i);
						if(!in_array($attribute->name,$allowed_attributes)) $node->removeAttributeNode($attribute);
					}
				}
			}
			foreach($domElemsToRemove as $domElement ){ 
				$domElement->parentNode->removeChild($domElement); 
			} 
			// restore
			libxml_clear_errors();
			libxml_use_internal_errors($libxml_previous_state);
			return $dom->saveHTML();
		} else {
			// restore
			libxml_clear_errors();
			libxml_use_internal_errors($libxml_previous_state);
			return null;
		}
	}
	
}
