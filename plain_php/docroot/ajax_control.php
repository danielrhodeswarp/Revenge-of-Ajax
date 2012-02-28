<?php

/**
 * @package    Revenge of Ajax (https://github.com/danielrhodeswarp/Revenge-of-Ajax)
 * @copyright  Copyright (c) 2012 Warp Asylum Ltd (UK).
 * @license    see LICENCE file in source code root folder     New BSD License
 */

//NOTE THAT THIS FILE IS AN ENTRY POINT INTO YOUR APPLICATION!!

session_cache_limiter('private, must-revalidate');	//probably no effect...
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

//include 'my_include_files.php';
include $_SERVER['DOCUMENT_ROOT'] . '/../php/ajax_model.php';

//session_start();	//Need to have *after* class defs to then save those classes in sessions	

//Class representing the Ajax controller (controller as in "MVC")
class AjaxControl
{
	//properties
	var $ajaxModel;
	
	//constructor
	function __construct()
	{
		$this->ajaxModel = new AjaxModel();
	}
	
	//send the results of a model function to the client browser
	function sendResponse($response)
	{
		if($_REQUEST['format'] == 'html' or $_REQUEST['format'] == 'json')
		{
			header('Content-type: text/html; charset=utf-8');
			echo $response;
		}
		
		elseif($_REQUEST['format'] == 'xml')
		{
			header('Content-type: text/xml; charset=utf-8');
			echo '<?xml version="1.0" encoding="utf-8"?><rootNode>' . $response . '</rootNode>';	//default root node?
		}
	}
}


//main
$ajaxControl = new AjaxControl();
$ajaxControl->sendResponse($ajaxControl->ajaxModel->{$_REQUEST['action']}());	//send response to client browser
