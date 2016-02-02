Ext.onReady(function() {
	msocial.config.connector_url = OfficeConfig.actionUrl;

	var grid = new msocial.panel.Home();
	grid.render('office-msocial-wrapper');

	var preloader = document.getElementById('office-preloader');
	if (preloader) {
		preloader.parentNode.removeChild(preloader);
	}
});