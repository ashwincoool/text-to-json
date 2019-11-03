<?php
/*
* This file is use to convert single blog text file into json format
*/

error_reporting(0); //Turn off all error reporting, specific error E_ERROR | E_WARNING | E_PARSE | E_NOTICE


$libInclude = include "textToJson.php"; //include library 

if(!is_numeric($libInclude)){ //check library is include with an numeric condition
	echo "Missing Text to json Library!";exit;
}


$fileData = file_get_contents("data.txt");

// Create a new object, pass all file content
$obj = new textToJson($fileData);
$obj->processFileData();//call function to process data
$jsonBlogData = json_encode($obj->resultBlogData, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);//get process data by access the public variable, use pritty print and remove slashes from data 

echo "<pre>".$jsonBlogData."</pre>";

?>