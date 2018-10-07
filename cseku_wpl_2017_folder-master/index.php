<?php

include_once '/common/class.common.php';

$_URI = $_SERVER['REQUEST_URI'];

$new_url = unparse_url(parse_url($_URI));


if(isset($new_url)){

	// including all the content of the component page in this index page
	include $new_url;
}

//finding different partse of an url
function unparse_url($parsed_url) { 
	$scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : ''; 
	$host     = isset($parsed_url['host']) ? $parsed_url['host'] : ''; 
 	$port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : ''; 
 	$user     = isset($parsed_url['user']) ? $parsed_url['user'] : ''; 
 	$pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : ''; 
 	$pass     = ($user || $pass) ? "$pass@" : ''; 
 	$path     = isset($parsed_url['path']) ? $parsed_url['path'] : ''; 
 	$query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : ''; 
 	$fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : ''; 

 	//extracting the page name such as user.php from the url
 	$page = substr($path, strrpos($path,'/')+1,strrpos($path,'.php')-strrpos($path,'/')+strlen('.php'));

 	//looking for the extracted page in the route list

 	$new_page=RouteUtil::get($page);

 	//rebuilding the page
 	//$path=str_replace('/'.$page, $new_page, $path);

 	return $new_page;
	//return "$scheme$user$pass$host$port$path$query$fragment"; 
} 

?>