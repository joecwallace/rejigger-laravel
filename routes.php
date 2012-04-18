<?php

Route::get('(:bundle)/rejigger.js', array('as' => 'rejigger_js', function()
{
	return View::make('rejigger::js');
}));

Route::get('(:bundle)/version', array('as' => 'rejigger_version', function()
{
	// Don't let the controller mistake this for a regular AJAX call
	unset($_SERVER['HTTP_X_REQUESTED_WITH']);

	$uri = \Rejigger\URI::resolve(Input::get('uri'));
	$route = \Laravel\Routing\Router::route('GET', $uri);
	$response = $route->call();

	$version = md5($response->content);

	// Parse out resources (css & script)
	preg_match_all('/\<script[^\>]+src=\"(?P<src>[^\"]+)\"[^\>]*\>/i', $response->content, $scripts);
	preg_match_all('/\<link[^\>]+href=\"(?P<href>[^\"]+)\"[^\>]*\>/i', $response->content, $styles);
	$resources = array_merge($scripts['src'], $styles['href']);

	$public = path('public');
	foreach ($resources as $resource)
	{
		$resource = $public . str_replace(\Laravel\URL::base(), '', $resource);
		if (\Laravel\File::exists($resource))
		{
			$version .= File::modified($resource);
		}
	}

	return '{ "version": "' . md5($version) . '" }';
}));