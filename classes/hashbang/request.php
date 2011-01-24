<?php defined('SYSPATH') or die('No direct script access.');

class Hashbang_Request extends Kohana_Request {

	public static $hashbang_redirect_get = FALSE;

	public static $hashbang_redirect_code = 301;

	public static function instance( & $uri = TRUE)
	{
		if ( ! Request::$instance)
		{
			if (isset($_GET['_escaped_fragment_']))
			{
				// Capture the hashbang
				$redirect = $_GET['_escaped_fragment_'];

				if (Request::$hashbang_redirect_get)
				{
					// Append all GET parameters and remove the hashbang
					$redirect .= URL::query(array('_escaped_fragment_' => NULL));
				}
			}
		}

		// Get the instance
		$instance = parent::instance($uri);

		if (isset($redirect))
		{
			$instance->redirect($redirect, Request::$hashbang_redirect_code);
		}

		return $instance;
	}

} // End Hashbang_Request
