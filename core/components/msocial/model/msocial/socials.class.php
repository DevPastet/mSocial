<?php
/**
* Класс social родитель для классов соцсетей
* @copyright  Copyright (c) 2016 devPastet (Pavel Karelin) devpastet@yandex.ru
*/
class socials 
{
	
	/**
     * @var mixed
    */
	public $modx;
	
	/**
     * @var array
    */
	public $setting;
	
	public function __construct(modX & $modx, $setting) 
	{
		$this->modx = $modx;
		$this->setting = $setting;
	}
	
	/**
     * Метод для постинга
     */
	public function posting()
	{
	}
	
	/**
     * Загрузка изображений
     */
	public function uploadImg($file)
	{
	}
	
	/**
     * Направляем CURL запрос
	 * 
	 * @var $url string - url для запроса
	 * @var $param mixed - параметры для запроса
     */
	public function request($url, $param)
	{
		$options = array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER => false, 
			CURLOPT_FOLLOWLOCATION => false,   
			CURLOPT_ENCODING => "",     
			CURLOPT_USERAGENT => "mSocial",
			CURLOPT_AUTOREFERER => true,  
			CURLOPT_CONNECTTIMEOUT => 120,    
			CURLOPT_TIMEOUT => 120,    
			CURLOPT_MAXREDIRS => 10, 
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $param
		);
		$ch = curl_init( $url );
		curl_setopt_array( $ch, $options );
		$curlResult = curl_exec( $ch );
		$result = json_decode( $curlResult );
		
		curl_close( $ch );
		return $result;
	}
	
}

?>