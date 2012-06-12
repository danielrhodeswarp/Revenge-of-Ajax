# Revenge of Ajax

## What is it?

It is a very useable and very well tested ajax engine for PHP web apps.
The backend has historically been plain PHP, but there is now also a Zend Framework version.
It has been designed to be easy to call from JavaScript.

## What does it need to run?

* Browser with JavaScript enabled
* PHP 5 (4 *might* work for the plain PHP version) / Zend Framework web app

## Example usage

```javascript
function anAjaxCall(someParameter)
{
   a.jax({action:'gettext', method:'GET', format:'text', reaction:anAjaxCallReaction, parameter_to_pass:someParameter});
}

function anAjaxCallReaction(responseText)
{
   alert('Ajax says: ' + responseText);
}
```

## Parameters that have defaults and don't need to be set explicitly

* method : 'GET'
* asynchronous : true
* format : 'html'
* controller : 'ajax' (or '/ajax_control.php' for the plain PHP version) 

## Integration instructions

Please look at the test page and the source code for your desired version (plain PHP or Zend Framework).
Set up the version you need as a vhost and you'll get the test page.

## What's hot?

* JavaScript interface is pretty easy
* An "integrate once and then forget about it" solution!

## What's not?

* A call of a.jax({internal_settings:'value', ...}, {parameters_to_pass:someParameter, ...}); might look and feel better
* Be careful not to use names of internal settings as parameter names of values to pass
* It's controllable, but the *default* is for all of the ajax actions to go in the same controller. This may or may not be what you want.

## TODO

* jQuery support
* support for in-place definition of callback function?
