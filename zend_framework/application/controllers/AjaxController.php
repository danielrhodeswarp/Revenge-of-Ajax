<?php

class AjaxController extends Zend_Controller_Action
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
    	
    			
		//as explained at http://framework.zend.com/manual/en/zend.controller.actionhelpers.html
		
		$contextSwitch = $this->_helper->getHelper('contextSwitch');
			//following actually means that getxml action has an
			//XML return *as well as* a normal, HTML return!
        $contextSwitch->addActionContext('getxml', 'xml')->initContext();
        $contextSwitch->addActionContext('getdodgyxml', 'xml')->initContext();
        
   		$contextSwitch->addActionContext('getjson', 'json')->initContext();	//no view script is needed at all! (defaults to a JSON serialising of all view variables)
    }

    public function indexAction()
    {
        // action body
    }

    public function gettextAction()
    {
        $this->view->response = 'Here is some text retrieved by ajax (from Ajax controller)';
    }

    public function getjsonAction()
    {
        $this->view->something = 'or other';
    	
    	$food = array('pizza', 'burger', 'hotdog', 'and a diet coke');
    	
    	$this->view->food = $food;
    }

    public function getxmlAction()
    {
        $this->view->response = '<sometag someattribute="7">some content</sometag>';
    }

    public function gettextuserparmsAction()
    {
        $user_parms = array();
    	$user_parms['any_extra_parms'] = $this->_request->getParam('any_extra_parms');
    	$user_parms['like_this'] = $this->_request->getParam('like_this');
    	$user_parms['my_passed_array'] = $this->_request->getParam('my_passed_array');
    	
    	$this->view->response = "Here is some text retrieved by ajax (from Ajax controller)\nYou passed these parms:\n";
    	
    	$this->view->response .= var_export($user_parms);
    }

    public function getdodgyxmlAction()
    {
        //so, for example, something has gone terribly wrong and we can't
    	//return the XML we thought we could:
    	
    	$this->view->response = '<ajaxerror>Error message here (contents of &lt;ajaxerror&gt; tag)</ajaxerror><sometag someattribute="8">some content</sometag>';
    }

    public function posttomeAction()
    {
        $posted_parms = array();
    	$posted_parms['my_posted_parm'] = $this->_request->getParam('my_posted_parm');
    	$posted_parms['my_posted_array'] = $this->_request->getParam('my_posted_array');
    	    	
    	$this->view->response = "You have POSTed these parms to the Ajax controller:\n";
    	
    	$this->view->response .= var_export($posted_parms);
    }

    public function gettextwithlayoutAction()
    {
        $this->getHelper('layout')->enableLayout();
        
    	$this->view->response = '[Here, in square brackets is the complete text retrieved by ajax (from Ajax controller)]';
    }
}
