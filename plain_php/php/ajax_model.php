<?php

/**
 * @package    Revenge of Ajax (https://github.com/danielrhodeswarp/Revenge-of-Ajax)
 * @copyright  Copyright (c) 2012 Warp Asylum Ltd (UK).
 * @license    see LICENCE file in source code root folder     New BSD License
 */

//Class representing the Ajax model (model as in "MVC")
class AjaxModel
{
	
	//Constructor
	function __construct()
	{
		//anti URL hacking check
		if(!array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) or $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')
		{
			//echo 'You aren\'t JavaScript! Go away!';	//echoing anything is optional of course!
			exit;
		}
		
	}


		public function gettext()
    	{
        	return 'Here is some text retrieved by ajax (from ajax_model.php)';
    	}

    	public function getjson()
    	{
        	$food = array('pizza', 'burger', 'hotdog', 'and a diet coke');
    	
    		return json_encode($food);	//simply return a JSON formatted string
    	}

    	public function getxml()
    	{
        	return '<sometag someattribute="7">some content</sometag>';
    	}

    public function gettextuserparms()
    {
        $user_parms = array();
    	$user_parms['any_extra_parms'] = $_REQUEST['any_extra_parms'];
    	$user_parms['like_this'] = $_REQUEST['like_this'];
    	$user_parms['my_passed_array'] = $_REQUEST['my_passed_array'];
    	
    	$string = "Here is some text retrieved by ajax (from ajax_model.php)\nYou passed these parms:\n";
    	
    	return $string . var_export($user_parms, true);
    }

    public function getdodgyxml()
    {
        //so, for example, something has gone terribly wrong and we can't
    	//return the XML we thought we could:
    	
    	return '<ajaxerror>Error message here (contents of &lt;ajaxerror&gt; tag)</ajaxerror><sometag someattribute="8">some content</sometag>';
    }

    public function posttome()
    {
        $posted_parms = array();
    	$posted_parms['my_posted_parm'] = $_REQUEST['my_posted_parm'];
    	$posted_parms['my_posted_array'] = $_REQUEST['my_posted_array'];
    	    	
    	$string = "You have POSTed these parms to the Ajax controller:\n";
    	
    	return $string . var_export($posted_parms, true);
    }
	
	
}
