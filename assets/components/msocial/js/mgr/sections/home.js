msocial.page.Home = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		components: [{
			xtype: 'msocial-panel-home', renderTo: 'msocial-panel-home-div'
		}]
	});
	msocial.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(msocial.page.Home, MODx.Component);
Ext.reg('msocial-page-home', msocial.page.Home);