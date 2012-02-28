<?php

/**
 * @package    Revenge of Ajax (https://github.com/danielrhodeswarp/Revenge-of-Ajax)
 * @copyright  Copyright (c) 2012 Warp Asylum Ltd (UK).
 * @license    see LICENCE file in source code root folder     New BSD License
 */

class SomeotherController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	
    	//don't seem to need if XML output via addActionContext() [think it does this for us if XML]
    	//also, if JSON then no view script is needed at all! (defaults to a JSON serialising of all view variables)
    	$this->getHelper('layout')->disableLayout();	//*IF* you have layouting enabled
    	
    	
    	if($this->_request->isXmlHttpRequest())
    	{
    		//request has reached us from an ajax call
    	}
    	
    	else
    	{
    		//IF THIS BLOCK IS EMPTY then your views for
    		//your ajax actions (regardless of them being html or json or xml or whatever)
    		//can be visible by typing the appropriate url into the browser
    		//(eg. myzfproject.com/ajax/gettext?format=html)
    		//you probably DON'T want this to happen
    		
    		    		
    		//do this for a white screen of death:
    		EXIT;	//crude perhaps but prevents triggering of ajax actions by URL hacking / guessing
    	
    	}
    	
    }

    public function indexAction()
    {
        // action body
    }

    public function gettextAction()
    {
        // action body
        
    	$this->view->response = 'Here is some text retrieved by ajax (from Someother controller)';
    }

    public function getTextButActionIsCamelCasedAction()
    {
        // action body
        
    	$this->view->response = 'Here is some text retrieved by ajax (from Someother controller with a camelCasedActionName)';
    }

}


