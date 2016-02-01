<?php
/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var msocial $msocial */
$msocial = $modx->getService('msocial', 'msocial', $modx->getOption('msocial_core_path', null, $modx->getOption('core_path') . 'components/msocial/') . 'model/msocial/');
$modx->lexicon->load('msocial:default');

// handle request
$corePath = $modx->getOption('msocial_core_path', null, $modx->getOption('core_path') . 'components/msocial/');
$path = $modx->getOption('processorsPath', $msocial->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));