# Hashbang

__Before using this module, I highly recommend reading [Broken URLs](http://www.tbray.org/ongoing/When/201x/2011/02/09/Hash-Blecch) by Tim Bray. Using hashbang URLs is pretty bad for web standards and the web in general. Proceed if you absolutely must.__

Many web applications are now using the #! ("hashbang") URL syntax, where all internal links are loaded using AJAX and only the hash is modified. Google has announced a [AJAX URL crawling specification](http://code.google.com/web/ajaxcrawling/docs/getting-started.html) to allow these links to be crawled without using Javascript. Simply put, any link such as `/#!/foo` is requested as `/?_escaped_fragment_=/foo`.

This module overloads the [Kohana](http://kohanaframework.org/) `Request::instance` method to redirect all `_escaped_fragment_` requests to real URLs. Hashbang assumes that any URL `/#!/foo/bar` displays the same content as `/foo/bar`. Your application URLs must follow this format or Hashbang will not work as expected.

## Installation

Install to `modules/hashbang` and then add it to your `Kohana::modules` call in `application/bootstrap.php`:

    Kohana::modules(array(
        ...
        'hashbang' => MODPATH.'hashbang',
        ...
    ));

When `Request::instance` is called for the first time, Hashbang will check for `$_GET['_escaped_fragment_']` and redirect if it is set.

## Configuration

To set the redirect HTTP status, change `Request::$hashbang_redirect_code` to a 3xx value. The default value is `301`.

To redirect GET parameters, set `Request::$hashbang_redirect_get` to `TRUE`. The default value is `FALSE`.

## Extending Request

If you are extending the `Request` class in your application, the class must extend `Hashbang_Request`! If other modules extend `Request` it will very likely cause unexpected results.
