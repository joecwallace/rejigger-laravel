# Rejigger

__Rest your refresh button__

## Description

Rejigger allows you to work without using the refresh button so often. All you have to do is enable it and watch your updates happen instantaneously.

## Installation

    php artisan bundle:install rejigger

#### Add something like this to ```application/bundles.php```:

    return array(
    	'rejigger' => array(
	        'auto' => true,
	        'handles' => 'rejigger',
    	),
    );