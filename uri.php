<?php namespace Rejigger;

class URI extends \Laravel\URI
{

	public static function resolve($uri)
	{
		// Place trailing slash on base URL
		$uri = static::remove($uri, rtrim(\Laravel\URL::base(), '/#'));
		$uri = rtrim($uri, '#');

		static::$uri = static::format($uri);
		static::segments(static::$uri);

		return static::$uri;
	}

}