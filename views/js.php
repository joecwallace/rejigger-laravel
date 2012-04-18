<?= File::get(Bundle::path('rejigger') . 'jquery/jquery-1.7.2.min.js') ?>
var reJquery = jQuery.noConflict(true);

var rejigger_version;
var rejigger_version_uri = "<?= URL::to_route('rejigger_version') ?>";

reJquery(document).ready(function() {
	rejigger();
});

function rejigger() {
	reJquery.getJSON(rejigger_version_uri, {
		uri: window.location.href
	}, function(data) {
		if (typeof rejigger_version == 'undefined') {
			rejigger_version = data.version;
		}

		if (rejigger_version != data.version) {
			window.location.reload(true);
		}
		else {
			setTimeout("rejigger()", <?= Config::get('rejigger::settings.update_milliseconds', '1000') ?>);
		}
	});
}