<?php

Autoloader::map(array(
	'Rejigger\\URI' => Bundle::path('rejigger') . 'uri.php',
));

$envs = Config::get('rejigger::settings.environments', array('*'));
if (in_array('*', $envs) ||
	(isset($_SERVER['LARAVEL_ENV']) && in_array($_SERVER['LARAVEL_ENV'], $envs)))
{
	Event::listen('laravel.done', function($response)
	{
		if (! (Request::route()->is('rejigger_js') || Request::route()->is('rejigger_version')))
		{
			echo HTML::script(URL::to_route('rejigger_js'));
		}
	});
}