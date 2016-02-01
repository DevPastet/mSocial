<?php

$settings = array();

$tmp = array(
	'im_ps' => array(
		'xtype' => 'combo-boolean',
		'value' => false,
		'area' => 'msocial_main'
	),
	'tw_tp' => array(
		'xtype' => 'textfield',
		'value' => 'tpl.msocial.tw',
		'area' => 'Twitter'
	),
	'tt_ot' => array(
		'xtype' => 'textfield',
		'value' => '',
		'area' => 'Twitter'
	),
	'tw_os' => array(
		'xtype' => 'textfield',
		'value' => '',
		'area' => 'Twitter'
	),
	'tw_ck' => array(
		'xtype' => 'textfield',
		'value' => '',
		'area' => 'Twitter'
	),
	'tw_cs' => array(
		'xtype' => 'textfield',
		'value' => '',
		'area' => 'Twitter'
	),
	
);

foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => 'msocial_' . $k,
			'namespace' => PKG_NAME_LOWER,
		), $v
	), '', true, true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
