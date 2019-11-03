<?php

/***
* Author : Ashwin 
* Purpose : Convert Blog Text to standard Array Format
* Description : This Class file can convert blog text file data into standard array format.
* Modified By : Ashwin
* Last Action Date : 02-11-2019
********************/

class textToJson 
{
	
	//declare variables
	private $fileContent;
	public $resultBlogData;

	function __construct($params)
	{
		  //assign params to variable
		 $this->fileContent=$params;

	}


	public function processFileData(){

	$data = explode(PHP_EOL, $this->fileContent); //text to array by new line 
	
	foreach ($data as $key => $value) {

	$arr = explode(":", $value, 2); //if colon exist create new array
	if(isset($arr[0]) && isset($arr[1])){ //check new array is created
		
		//assigne value in variable
		$first = $arr[0];
		$second = $arr[1];

		if($first=="tags"){ // check if tags is present then need to create new array of their values 
					$mainArray[$first] = explode(", ",trim($second));
			}else{
					$mainArray[$first] =  trim($second,'" ');
			}
		
		}else{

			if($this->isValidString($value)==true){ //check if value is a valid string
				
				$descriptionArray[] =  trim($value); //hold all description data into variable.
			
			 }
				
			
			}


		}

  $completeDescription =  implode(" ", $descriptionArray); //combine all data in one varible

if(strpos($completeDescription,"READMORE") !== false){ //find readmore in string if present then create two new varible  short and long description
    list($shortDescription, $lngDescription) = explode('READMORE', $completeDescription, 2); 
}

if(isset($shortDescription) && isset($lngDescription)){
	$contentArray = array("short-content" =>trim($shortDescription),"content"=>trim($lngDescription));//create new array
}

$blogArray = array_merge($mainArray,$contentArray);//merge two array

	$this->resultBlogData =$blogArray; //assign final array to main result 

}

/*
* this function is to validate string is valid or not
*/
private function isValidString($string) {
  	if (preg_match("/[a-z]/i", $string)) {
    // Valid
  		return true;
} else {
	return false;
    // Invalid
}
  }






}


?>