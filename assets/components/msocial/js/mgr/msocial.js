var msocial = function (config) {
	config = config || {};
	msocial.superclass.constructor.call(this, config);
};
Ext.extend(msocial, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('msocial', msocial);

msocial = new msocial();