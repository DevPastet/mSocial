<?php
/**
* Класс mSocial для инициализации и подключение классов постинга в соцсети. Текущий набор соцсетей: Tw.
* @copyright  Copyright (c) 2016 devPastet (Pavel Karelin) devpastet@yandex.ru
* @version    1.0.0 pre-alpha
*/

set_time_limit(0);

class mSocial 
{
	
	/**
     * @var mixed
    */
	public $setting;
	
	/**
     * @var mixed
    */
	public $modx;
	
	/**
     * @var string
    */
	public $soc;
	
	
	/*@var object $modx обьект modx */
	public function __construct(modX & $modx, $setting) 
	{
		$this->modx = $modx;
		$this->setting = $setting;
		
	    foreach($setting['activeSoc'] as $soc)
		{
			    $this->soc = $soc;
				$this->checkSocialAndDock();
	    }
	}
	
	/**
     * Определяем что есть класс соцсети и подключаем его
     */
	public function checkSocialAndDock()
	{ 
		if (file_exists(MODX_CORE_PATH . 'components/msocial/custom/network/'.$this->soc.'.class.php')) {
			$modx = $this->modx;
		    if($modx->loadClass($this->soc, MODX_CORE_PATH . 'components/msocial/custom/network/', true, true)){
		    	$this->getAndParseChunk($this->soc);
				$initSocial[$this->soc] = new $this->soc($modx, $this->setting);
				if($this->setting['method'] == 'posting'){
					$initSocial[$this->soc]->posting();
				}
			}
	    }
	}
	
	/**
     * Парсим шаблоны соцсетей
     */
	public function getAndParseChunk()
	{
		$chunkName = $this->modx->getOption('msocial_'.$this->soc.'_tp');
		$this->setting['message'] = $this->modx->getChunk($chunkName, $this->setting['allField']);	
		$this->modx->getParser()->processElementTags('', $this->setting['message'], true, true, '[[', ']]', array(), 10);
		$this->parseAttach();
		$this->clearMess();
	}
	
	/**
     * Чистим сообщение от html
     */
	public function clearMess(){ // 
		$this->setting['message'] = strip_tags(trim($this->setting['message']));
	}
	
	/**
     * Ищем и дергаем файлы для отправки
     */
	public function parseAttach()
	{
	    preg_match_all("/(<img )(.+?)( \/)?(>)/", $this->setting['message'],$images);
		foreach ($images[2] as $val)
		{
		    if (preg_match("/(src=)('|\")(.+?)('|\")/",$val,$matches) == 1)
			{
				if(file_exists(MODX_BASE_PATH.$matches[3]))
				{
					$this->setting['attach'][] = $matches[3];
				}
			}
		        
		}
	}
	
}
?>