<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript" src="/js/revenge_of_ajax.js"></script>
	<script type="text/javascript" src="/js/roa_test_suite.js"></script>
	<title>Revenge of Ajax test suite</title>
</head>
<body>
	<h1>Revenge of Ajax test suite (for plain PHP)</h1>

	<h2>Test sensible ajax calls</h2>
	<p>All of the following tests should alert the returned response</p>
	<ul>
		<li><button type="button" onclick="getTextFromAjaxController();">Test getting <em>text/html</em> from Ajax controller</button></li>
		<li><button type="button" onclick="getJsonFromAjaxController();">Test getting <em>json</em> from Ajax controller</button></li>

		<li><button type="button" onclick="getXmlFromAjaxController();">Test getting <em>xml</em> from Ajax controller</button></li>
		<li>---</li>
		<li><button type="button" onclick="getTextFromSomeotherController();">Test getting <em>text/html</em> from Someother controller</button></li>
		<li><button type="button" onclick="getTextFromSomeotherControllerCamelCasedAction();">Test getting <em>text/html</em> from Someother controller with a camelCasedActionName</button></li>

		<li>---</li>
		<li><button type="button" onclick="getTextFromAjaxControllerUserParms();">Test getting <em>text/html</em> <strong>and</strong> working with user parms from Ajax controller</button></li>
		<li><button type="button" onclick="getXmlFromAjaxControllerDodgy();">Test getting <em>xml</em> containing an &lt;ajaxerror&gt; tag from Ajax controller</button></li>

		<li>---</li>
		<li><button type="button" onclick="postToAjaxController();">Test <em>POSTing</em> to Ajax controller</button></li>
	</ul>
	<h2>Test probably erroneous ajax calls</h2>
	<ul>
		<li><button type="button" onclick="getTextAsJsonFromAjaxController();">Test getting <em>text/html</em> from Ajax controller but specifying <em>format=json</em></button>
		Works
		</li>
		<li><button type="button" onclick="getTextAsXmlFromAjaxController();">Test getting <em>text/html</em> from Ajax controller but specifying <em>format=xml</em></button>
		Works but only because the default return text is sandwiched between our &lt;rootNode&gt; (will no doubt lead to XML escaping issues...)
		
		<li>---</li>
		<li><button type="button" onclick="getJsonAsTextFromAjaxController();">Test getting <em>json</em> from Ajax controller but specifying <em>format=text/html</em></button>
		Works
		</li>
		<li><button type="button" onclick="getJsonAsXmlFromAjaxController();">Test getting <em>json</em> from Ajax controller but specifying <em>format=xml</em></button>
		Works but only because the default return JSON text is sandwiched between our &lt;rootNode&gt; (will no doubt lead to XML escaping issues...)
		</li>
		<li>---</li>
		<li><button type="button" onclick="getXmlAsTextFromAjaxController();">Test getting <em>xml</em> from Ajax controller but specifying <em>format=text/html</em></button>

		Works but simply returns the XML as a string (without our &lt;rootNode&gt;)</li>
		<li><button type="button" onclick="getXmlAsJsonFromAjaxController();">Test getting <em>xml</em> from Ajax controller but specifying <em>format=json</em></button>
		Works but simply returns the XML as a string (without our &lt;rootNode&gt;)</li>
		
		
		</li>
	</ul>
	<h2>Test URL hacking security</h2>
	<ul>
		<li>Go to <a href="/ajax_control.php?action=gettext&format=html">/ajax_control.php?action=gettext&amp;format=html</a> (HTTP 200 success but white screen of death)</li>

		<li>Go to <a href="/ajax_control.php?action=getxml&format=xml">/ajax_control.php?action=getxml&amp;format=xml</a> (HTTP 200 success but white screen of death)</li>
		<li>Go to <a href="/ajax_control.php?action=getjson&format=json">/ajax_control.php?action=getjson&amp;format=json</a> (HTTP 200 success but white screen of death)</li>
		<li>---</li>
		<li>Go to <a href="/someother_ajax_control.php?action=gettext&format=html">/someother_ajax_control.php?action=gettext&amp;format=html</a> (returned text visible <strong>because</strong> we haven't done anything in someother_ajax_model.php to prevent URL hacking)</li>

	</ul>
</body>
</html>
