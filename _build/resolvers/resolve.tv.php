<?php

if ($object->xpdo) {
	/** @var modX $modx */
	$modx =& $object->xpdo;

	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
			
			$where = array('name' => 'twPost');
			if(!$tv = $modx->getObject('modTemplateVar', $where)){
				$where = array('category' => 'msocial');
				if($category = $modx->getObject('modCategory', $where)){
					$categoryId = $category->get('id');
					
					$twTV = $modx->newObject('modTemplateVar');
					$twTV->set('name','twPost');
					$twTV->set('caption','Постим в twitter?');
					$twTV->set('type','checkbox');
					$twTV->set('elements','Да==1');
					$twTV->set('category',$categoryId);
					
					$twTV->save();
				}
			}
			
			break;

		case xPDOTransport::ACTION_UPGRADE:
			
			
			
			break;

		case xPDOTransport::ACTION_UNINSTALL:
			
			$where = array('name' => 'twPost');
			if($tv = $modx->getObject('modTemplateVar', $where)){
				$tv->remove();
			}
			
			break;
	}
}
return true;