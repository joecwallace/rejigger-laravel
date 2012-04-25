<?= File::get(Bundle::path('rejigger') . 'jquery/jquery-1.7.2.min.js') ?>
var reJquery = jQuery.noConflict(true);

var rejigger_version;
var rejigger_version_uri = "<?= URL::to_route('rejigger_version') ?>";

reJquery(document).ready(function() {
	rejigger();
});

function rejigger() {
	reJquery.get(rejigger_version_uri, {
		uri: window.location.href
	}, function(data) {
		if (data.charAt(0) == '{') {
			var json = (new Function("return " + data))();

			if (typeof rejigger_version == 'undefined') {
				rejigger_version = json.version;
			}

			if (rejigger_version == json.version) {
				setTimeout("rejigger()", <?= Config::get('rejigger::settings.update_milliseconds', '1000') ?>);
				return;
			}
		}

		window.location.reload(true);
	});
}