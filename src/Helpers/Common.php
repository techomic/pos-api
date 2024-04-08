<?php

namespace Vikuraa\Helpers;

use DI\Container;

class Common
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
	 * Is HTTPS?
	 *
	 * Determines if the application is accessed via an encrypted
	 * (HTTPS) connection.
	 *
	 * @return	bool
	 */
	function isHttps()
	{
		if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
			return TRUE;
		} elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
			return TRUE;
		} elseif (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
			return TRUE;
		}

		return FALSE;
	}
}