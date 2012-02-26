//----*Should* be able to minify this file safely with the various
//JavaScript minifiers that are out there----

//container for requestObject, callback function etc
function AjaxContainer()
{
	//properties
	//----------
	this.requestObject;
	
	//methods
	//--------
	this.initialize = function()	//create a request object
	{
		//Mozilla, Opera, Safari from the year dot and IE from 7
		if(window.XMLHttpRequest)
		{
			this.requestObject = new XMLHttpRequest();
		}
		
		//older IE versions (should we still support such old versions??)
		else if(window.ActiveXObject)	//is there a version 3.0?
		{
			try	//use version 2.0
			{
				this.requestObject = new ActiveXObject('MSXML2.XMLHTTP');
			}
			
			catch(error)	//use the original
			{
				this.requestObject = new ActiveXObject('Microsoft.XMLHTTP');
			}
		}
		
		//DOESN'T WORK here - prob coz we not open()ed the requestObject yet
		//
		//to trigger Zend Framework's $this->_request->isXmlHttpRequest()
		//this.requestObject.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	};
}

//event queue ("Ajax" with a capital "A" clashes with the Prototype library's Ajax class)
var a =
{
	//properties
	//----------
		//properties that MUST be passed when calling a.jax()
	action : '',	//ZF action name. changes for each different ajax functionality
	reaction : '',	//JavaScript reaction (callback) function name
	
		//properties with defaults (defaults ACTUALLY get set in jax() method)
	method : 'GET',	//HTTP method. Mozilla recommend uppercase*
	asynchronous : true,
	format : 'html',	//'html' (or its alias 'text') or 'xml' or 'json'
	//server : '/ajax_control.php',	//Ajax server (relative from client URL)
	controller : 'ajax',	//the default ZF controller URL name.
							//you don't *have* to pass this parm if you're happy with having all your ajax actions in the one default controller
		
		//internal properties
	ajaxContainers : new Object(),	//hash
	counter : 0,
	
	//methods
	//--------
	jax : function(allParms)
	{
		var counter = a.counter;	//using 'this' in the inline function refers to a different context
		
		a.ajaxContainers[counter] = new AjaxContainer();
		
		a.ajaxContainers[counter].initialize();
		
		//manage optional parameters (ie. parameters that have defaults)
		if(allParms['method'])
		{
			a.method = allParms['method'];
			delete allParms['method'];	//not needed by PHP
		}
		else
		{
			a.method = 'GET';	//set default
		}
		
		if(allParms['asynchronous'])
		{
			a.asynchronous = allParms['asynchronous'];
			delete allParms['asynchronous'];	//not needed by PHP
		}
		else
		{
			a.asynchronous = true;	//set default
		}
		
		if(allParms['controller'])
		{
			a.controller = allParms['controller'];
			delete allParms['controller'];	//not needed by PHP
		}
		else
		{
			a.controller = 'ajax';	//set default
		}
		
		if(allParms['format'])
		{
			a.format = allParms['format'];
			
			//for our 'html' alias of 'text'
			if(a.format == 'text')
			{
				a.format = 'html';
			}
		}
		else
		{
			a.format = 'html';	//set default
		}
			
		
		
		//manage required parameters
		
		
		//if(allParms['action'])
		//{
			a.action = allParms['action'];
			delete allParms['action'];	//not needed in allParms anymore
		//}
		
		a.reaction = allParms['reaction'];
		delete allParms['reaction'];	//not needed by PHP
		
		//stops the IE cache (or a better way? is caching perhaps useful??..)
		queryString = 'counter=' + counter;
		
		
		//add user parameters
		for(var item in allParms)
		{
			queryString += '&' + item + '=' + encodeURIComponent(allParms[item]);
		}
		
		//set reaction handler to this.reaction
		a.ajaxContainers[counter].requestObject.onreadystatechange = function()
		{
			if(a.ajaxContainers[counter].requestObject.readyState == 4)
			{
				if(a.ajaxContainers[counter].requestObject.status == 200)	//need?**
				{
					if(a.format == 'html' || a.format == 'json')	//handle as text
					{
						var responseText = a.ajaxContainers[counter].requestObject.responseText;
						
						//call the set reaction handler
						a.reaction.call(this, responseText);
					}
					
					else if(a.format == 'xml')	//handle as xml and support an <ajaxerror> tag
					{
						var responseXML = a.ajaxContainers[counter].requestObject.responseXML;
						var documentElement = responseXML.documentElement;
						
						//CUSTOM DEFAULT ERROR HANDLER (display error then die)-----------
						if(documentElement.getElementsByTagName('ajaxerror').length > 0)
						{
							alert(documentElement.getElementsByTagName('ajaxerror')[0].firstChild.nodeValue);
							
							//remove this request object
							delete a.ajaxContainers[counter];
							
							return;
						}
						//end CUSTOM DEFAULT ERROR HANDLER (display error then die)-------
						
						//call the set reaction handler
						a.reaction.call(this, documentElement);
					}
					
					//BEHAVIOUR LIBRARY IS ANCIENT!
					//if Behaviour library is loaded, reapply the rules
					//(because Ajax reactions often update / change the DOM)
					//if(typeof Behaviour != 'undefined')
					//{
					//	Behaviour.apply();
					//}
					
					//remove this request object
					delete a.ajaxContainers[counter];
					
					return;
				}
			}
		};
		
		//go!
		if(a.method == 'GET')
		{
			//the third parameter is "asynchronous or not"
			//a.ajaxContainers[counter].requestObject.open(a.method, a.server + '?' + queryString, a.asynchronous);
			a.ajaxContainers[counter].requestObject.open(a.method, '/' + a.controller + '/' + a.action + '?' + queryString, a.asynchronous);
			
			//for a debug:
			//alert(a.method + '::' + '/' + a.controller + '/' + a.action + '?' + queryString);
			
			//to trigger Zend Framework's $this->_request->isXmlHttpRequest()
			a.ajaxContainers[counter].requestObject.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
			
			a.ajaxContainers[counter].requestObject.send(null);
		}
		
		else if(a.method == 'POST')
		{
			//the third parameter is "asynchronous or not"
			//a.ajaxContainers[counter].requestObject.open(a.method, a.server, a.asynchronous);
			a.ajaxContainers[counter].requestObject.open(a.method, '/' + a.controller + '/' + a.action, a.asynchronous);
			
			//for a debug:
			//alert(a.method + '::' + '/' + a.controller + '/' + a.action + '\n' + '[' + queryString + ']');
			
			a.ajaxContainers[counter].requestObject.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			//this.ajaxContainers[timestamp].requestObject.setRequestHeader('Content-length', queryString.length);
			//this.ajaxContainers[timestamp].requestObject.setRequestHeader('Connection', 'close');
			
			//to trigger Zend Framework's $this->_request->isXmlHttpRequest()
			a.ajaxContainers[counter].requestObject.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
			
			a.ajaxContainers[counter].requestObject.send(queryString);
		}
		
		a.counter = counter + 1;
	}
};

//* Because it's the HTTP standard
//** Mozilla tutorial has it but works fine without