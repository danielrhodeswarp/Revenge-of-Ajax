<?php

/**
 * @package    Revenge of Ajax (https://github.com/danielrhodeswarp/Revenge-of-Ajax)
 * @copyright  Copyright (c) 2012 Warp Asylum Ltd (UK).
 * @license    see LICENCE file in source code root folder     New BSD License
 */

//Class representing the Ajax model (model as in "MVC")
class SomeotherAjaxModel
{
	
	//Constructor
	function __construct()
	{
		/*
		//anti URL hacking check
		if(!array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) or $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')
		{
			//echo 'You aren\'t JavaScript! Go away!';	//echoing anything is optional of course!
			exit;
		}
		*/
	}
	
	public function gettext()
   {
      return 'Here is some text retrieved by ajax (from someother_ajax_model.php)';
   }

	public function getTextButActionIsCamelCased()
   {
   	return 'Here is some text retrieved by ajax (from someother_ajax_model.php with a camelCasedActionName)';
   }
	
	
}
