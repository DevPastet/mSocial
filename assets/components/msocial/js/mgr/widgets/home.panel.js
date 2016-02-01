msocial.panel.Home = function (config) {
	config = config || {};
	Ext.apply(config, {
		baseCls: 'modx-formpanel',
		layout: 'anchor',
		/*
		 stateful: true,
		 stateId: 'msocial-panel-home',
		 stateEvents: ['tabchange'],
		 getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
		 */
		hideMode: 'offsets',
		items: [{
			html: '<h2>' + _('msocial') + '</h2>',
			cls: '',
			style: {margin: '15px 0'}
		}, {
			xtype: 'modx-tabs',
			defaults: {border: false, autoHeight: true},
			border: true,
			hideMode: 'offsets',
			items: [{
				title: _('msocial_items'),
				layout: 'anchor',
				items: [{
					html: _('msocial_intro_msg'),
					cls: 'panel-desc',
				}, {
					xtype: 'msocial-grid-items',
					cls: 'main-wrapper',
				}]
			}]
		}]
	});
	msocial.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(msocial.panel.Home, MODx.Panel);
Ext.reg('msocial-panel-home', msocial.panel.Home);
