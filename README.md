# Rejigger

___Rest your refresh button___

## Description

Rejigger allows you to develop with Laravel without using the refresh button so often. All you have to do is enable it and watch your updates happen instantaneously.

Rejigger inserts a little JavaScript at the end of the Laravel response. The JavaScript uses AJAX to ask Rejigger occasionally if the response - or any of its ```<script>```, ```<link>```, or ```<img>``` assets - has changed.

If one has, the Rejigger script requests a page reload.

## Installation

#### Install the bundle

    php artisan bundle:install rejigger

#### Fix up the last line of ```laravel/laravel.php```

    Event::fire('laravel.done', $response);

#### Add something like this to ```application/bundles.php```

    return array(
    	'rejigger' => array(
	        'auto' => true,
	        'handles' => 'rejigger',
    	),
    );

## Configuration

Rejigger's settings are in ```(:bundle)/config/settings.php```.

Rejigger can be configured to poll more or less frequently - e.g. every 5 seconds:

    return array('update_milliseconds' => 5000);
    
Or to only run in the 'local' environment - as determined by the 'LARAVEL_ENV' environment variable:

    return array('environments' => array('local'));
    
By default, Rejigger runs on all environments, so removing the 'environments' option does ***NOT*** turn it off. To disable it entirely:

    return array('environments' => array());

The default settings for Rejigger allow it to update every second and run in all environments:

    return array(
        'update_milliseconds' => 1000,
        'environments'        => array(
            '*',
        ),
    );
