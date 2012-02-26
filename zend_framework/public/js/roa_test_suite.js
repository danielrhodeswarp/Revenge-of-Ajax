//----sensible ajax calls--------

//
function getTextFromAjaxController()
{
	//actually, format of 'html' is the default and we don't really need to specify it
	//(same for method of 'GET')
	a.jax({action:'gettext', method:'GET', format:'html', reaction:getTextFromAjaxControllerReaction, any_extra_parms:'can_be_passed', like_this:'and_so_on'});
}

//
function getTextFromAjaxControllerReaction(responseText)
{
	alert(responseText);	//for a debug
	
	//here you would work with the text to show the user or
	//update the page or etc
}

//
function getJsonFromAjaxController()
{
	a.jax({action:'getjson', format:'json', reaction:getJsonFromAjaxControllerReaction, any_extra_parms:'can_be_passed', like_this:'and_so_on'});
}

//
function getJsonFromAjaxControllerReaction(responseJson)
{
	alert(responseJson);	//for a debug
	
	//here you would work with the JSON (probably with eval()) to
	//show the user or update the page or etc
}

//
function getXmlFromAjaxController()
{
	a.jax({action:'getxml', format:'xml', reaction:getXmlFromAjaxControllerReaction, any_extra_parms:'can_be_passed', like_this:'and_so_on'});
}

//
function getXmlFromAjaxControllerReaction(responseXml)
{
	alert(responseXml + "\nSpecifically:\n" + xml_to_string(responseXml));	//for a debug
	
	//here you would work with the XML to show the user or
	//update the page or etc
}

//
function getTextFromSomeotherController()
{
	//we can also give a format of 'text' (which means same as format of 'html')
	a.jax({controller:'someother', action:'gettext', format:'text', reaction:getTextFromSomeotherControllerReaction, any_extra_parms:'can_be_passed', like_this:'and_so_on'});

}

//
function getTextFromSomeotherControllerReaction(responseText)
{
	alert(responseText);	//for a debug
	
	//here you would work with the text to show the user or
	//update the page or etc
}

//
function getTextFromSomeotherControllerCamelCasedAction()
{
	//note the action URL name is all lower case with hyphens representing the case jumps
	a.jax({controller:'someother', action:'get-text-but-action-is-camel-cased', format:'text', reaction:getTextFromSomeotherControllerCamelCasedActionReaction, any_extra_parms:'can_be_passed', like_this:'and_so_on'});

}

//
function getTextFromSomeotherControllerCamelCasedActionReaction(responseText)
{
	alert(responseText);	//for a debug
	
	//here you would work with the text to show the user or
	//update the page or etc
}

//
function getTextFromAjaxControllerUserParms()
{
	//actually, format of 'text' is the default and we don't really need to specify
	//(same for method of 'GET')
	a.jax({action:'gettextuserparms', format:'text', reaction:getTextFromAjaxControllerUserParmsReaction, any_extra_parms:'can_be_passed', like_this:'and_so_on', my_passed_array:['one', 'two', 'three']});
}

//
function getTextFromAjaxControllerUserParmsReaction(responseText)
{
	alert(responseText);	//for a debug
	
	//here you would work with the text to show the user or
	//update the page or etc
}

//
function getXmlFromAjaxControllerDodgy()
{
	a.jax({action:'getdodgyxml', format:'xml', reaction:getXmlFromAjaxControllerDodgyReaction, any_extra_parms:'can_be_passed', like_this:'and_so_on'});
}

//
function getXmlFromAjaxControllerDodgyReaction(responseXml)
{
	//NOTHING IN HERE WILL EXECUTE if responseXml has an <ajaxerror> tag in it!
	
	alert('You will not see this alert');	//for a debug
	
	//here you would work with the XML to show the user or
	//update the page or etc
}

//
function postToAjaxController()
{
	//actually, format of 'text' is the default and we don't really need to specify
	//(same for method of 'GET')
	a.jax({action:'posttome', method:'POST', format:'text', reaction:postToAjaxControllerReaction, my_posted_parm:'a posted val', my_posted_array:['happy', 'posting']});
}

//
function postToAjaxControllerReaction(responseText)
{
	alert(responseText);	//for a debug
	
	//here you would work with the text to show the user the results of POSTing or
	//update the page or etc
}

//----probably erroneous ajax calls--------

//
function getTextAsJsonFromAjaxController()
{
	a.jax({action:'gettext', format:'json', reaction:getTextAsJsonFromAjaxControllerReaction, any_extra_parms:'can_be_passed', like_this:'and_so_on'});
}

//
function getTextAsJsonFromAjaxControllerReaction(responseJson)
{
	alert(responseJson);	//for a debug
}

//
function getTextAsXmlFromAjaxController()
{
	a.jax({action:'gettext', format:'xml', reaction:getTextAsXmlFromAjaxControllerReaction, any_extra_parms:'can_be_passed', like_this:'and_so_on'});
}

//
function getTextAsXmlFromAjaxControllerReaction(responseXml)
{
	alert(responseXml);	//for a debug
}

//
function getJsonAsTextFromAjaxController()
{
	a.jax({action:'getjson', format:'text', reaction:getJsonAsTextFromAjaxControllerReaction, any_extra_parms:'can_be_passed', like_this:'and_so_on'});
}

//
function getJsonAsTextFromAjaxControllerReaction(responseText)
{
	alert(responseText);	//for a debug
}

//
function getJsonAsXmlFromAjaxController()
{
	a.jax({action:'getjson', format:'xml', reaction:getJsonAsXmlFromAjaxControllerReaction, any_extra_parms:'can_be_passed', like_this:'and_so_on'});
}

//
function getJsonAsXmlFromAjaxControllerReaction(responseXml)
{
	alert(responseXml);	//for a debug
}

//
function getXmlAsTextFromAjaxController()
{
	a.jax({action:'getxml', format:'text', reaction:getXmlAsTextFromAjaxControllerReaction, any_extra_parms:'can_be_passed', like_this:'and_so_on'});
}

//
function getXmlAsTextFromAjaxControllerReaction(responseText)
{
	alert(responseText);	//for a debug
}

//
function getXmlAsJsonFromAjaxController()
{
	a.jax({action:'getxml', format:'json', reaction:getXmlAsJsonFromAjaxControllerReaction, any_extra_parms:'can_be_passed', like_this:'and_so_on'});
}

//
function getXmlAsJsonFromAjaxControllerReaction(responseJson)
{
	alert(responseJson);	//for a debug
}

//
function getTextWithLayoutFromAjaxController()
{
	a.jax({action:'gettextwithlayout', method:'GET', format:'text', reaction:getTextWithLayoutFromAjaxControllerReaction, any_extra_parms:'can_be_passed', like_this:'and_so_on'});
}

//
function getTextWithLayoutFromAjaxControllerReaction(responseText)
{
	alert(responseText);	//for a debug
}

//----utility--------
function xml_to_string(xml_node)	//got this from http://stackoverflow.com/questions/349250/how-to-display-xml-in-javascript
{
    if (xml_node.xml)
        return xml_node.xml;
    else if (XMLSerializer)
    {
        var xml_serializer = new XMLSerializer();
        return xml_serializer.serializeToString(xml_node);
    }
    else
    {
        //alert("ERROR: Extremely old browser");
        //return "";
    	return "(couldn't serialise XML with this browser)";
    }
}
