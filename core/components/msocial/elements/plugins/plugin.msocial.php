<?php
/**
* Плагин mSocial для постинга в соцсети.
* @copyright  Copyright (c) 2016 devPastet (Pavel Karelin) devpastet@yandex.ru
*/


if ($modx->loadClass('mSocial', MODX_CORE_PATH . 'components/msocial/model/msocial/', true, true)) 
{
    //Получаем лексиконы
    $modx->lexicon->load('msocial:default');
                    
    /* Список полей для постинга */
    $setting['allField'] = $resource->toArray();
    	
    	
    /* Список tv полей для постинга */
    $tv_query = $modx->newQuery('modTemplateVarResource');
    $tv_query->leftJoin('modTemplateVar','modTemplateVar',array("modTemplateVar.id = tmplvarid"));
    $tv_query->where(array('contentid'=>$resource->get('id')));
    $tv_query->select($modx->getSelectColumns('modTemplateVarResource','modTemplateVarResource','',array('id','tmplvarid','contentid','value')));
    $tv_query->select($modx->getSelectColumns('modTemplateVar','modTemplateVar','',array('name')));
    $tvars = $modx->getCollection('modTemplateVarResource',$tv_query);
    foreach ($tvars as $tvar) {
        $tvar = $tvar->toArray();
        if (!empty($tvar['value']))
                $setting['allField'][$tvar['name']] = $tvar['value'];
    }
    	
    // добавляем твиттер  	
    if($resource->getTVValue('twPost')){ 
        $setting['activeSoc'][] = 'tw';
    }
    
    // добавляем вк
    if($resource->getTVValue('vkPost')){ 
        $setting['activeSoc'][] = 'vk';
    }
     
    // добавляем fb
    if($resource->getTVValue('fbPost')){ 
        $setting['activeSoc'][] = 'fb';
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