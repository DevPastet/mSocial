<?php
/**
* Плагин mSocial для постинга в соцсети.
* @copyright  Copyright (c) 2016 devPastet (Pavel Karelin) devpastet@yandex.ru
* @version    1.0.0 pre-alpha
*/

if ($modx->loadClass('mSocial', MODX_CORE_PATH . 'components/msocial/model/msocial/', true, true)) 
{
    //Получаем лексиконы
    $modx->lexicon->load('msocial:default');
                
    /* Список полей для постинга */
    $setting['allField'] = array(
        'id' => $resource->get('id'),
        'type' => $resource->get('type'),
        'contentType' => $resource->get('contentType'),
        'pagetitle' => $resource->get('pagetitle'),
        'longtitle' => $resource->get('longtitle'),
        'description' => $resource->get('description'),
        'alias' => $resource->get('alias'),
        'link_attributes' => $resource->get('link_attributes'),
        'published' => $resource->get('published'),
        'pub_date' => $resource->get('pub_date'),
        'unpub_date' => $resource->get('unpub_date'),
        'parent' => $resource->get('parent'),
        'isfolder' => $resource->get('isfolder'),  
        'introtext' => $resource->get('introtext'),  
        'content' => $resource->get('content'), 
        'richtext' => $resource->get('richtext'), 
        'template' => $resource->get('template'), 
        'menuindex' => $resource->get('menuindex'), 
        'createdby' => $resource->get('createdby'), 
        'createdon' => $resource->get('createdon'), 
        'editedby' => $resource->get('editedby'), 
        'editedon' => $resource->get('editedon'), 
        'publishedon' => $resource->get('publishedon'), 
        'publishedby' => $resource->get('publishedby'), 
        'menutitle' => $resource->get('menutitle'),
		'hidemenu' => $resource->get('hidemenu'),
		'class_key' => $resource->get('class_key'),
		'context_key' => $resource->get('context_key'),
		'content_type' => $resource->get('content_type')
    );
    
    // добавляем постинг в tw        	
    if($resource->getTVValue('twPost')){ 
        $setting['activeSoc'][] = 'tw';
    }
            	
    // Определяем метод действий
    $setting['method'] = 'posting';
	
	if(count($setting['activeSoc']) > 0){
		$mSocial = new mSocial($modx, $setting);
	}
              
}else{
    $modx->log(modX::LOG_LEVEL_ERROR, "Не удалось подключить класс mSocial в ".MODX_CORE_PATH."/components/msocial/model/");
    return false;
}