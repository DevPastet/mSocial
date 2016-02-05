<?php
/**
* Класс tw для постинга в соответствующую соцсеть (использует библиотеку TwitterAPIExchange).
* @copyright  Copyright (c) 2016 devPastet (Pavel Karelin) devpastet@yandex.ru
*/
class tw
{
	/**
     * @var mixed
    */
	public $modx;
	
	/**
     * @var array
    */
	public $setting;
	
	/**
     * @var array
    */
	public $twKeys;
	
	public function __construct(modX & $modx, $setting) 
	{
		require_once MODX_CORE_PATH . 'components/msocial/custom/network/lib/tw/TwitterAPIExchange/TwitterAPIExchange.php';
		
		$this->modx = $modx;
		$this->setting = $setting;
		
		$this->twKeys['oauth_access_token'] = trim($this->modx->getOption('msocial_tt_ot'));
		$this->twKeys['oauth_access_token_secret'] = trim($this->modx->getOption('msocial_tw_os'));
		$this->twKeys['consumer_key'] = trim($this->modx->getOption('msocial_tw_ck'));
		$this->twKeys['consumer_secret'] = trim($this->modx->getOption('msocial_tw_cs'));
				
	}
	
	/**
     * Метод для постинга
     */
	public function posting()
	{
		$url = 'https://api.twitter.com/1.1/statuses/update.json';
		$requestMethod = 'POST';
		
		$postfields = array(
		    'status' => $this->setting['message']
		);
				
		if(isset($this->setting['attach']) AND $this->modx->getOption('msocial_im_ps') == 1)
		{
			$count = 1;
			foreach($this->setting['attach'] as $file)
			{
				if($count <= 4)
				{
					$reqImg = $this->uploadImg($file);
					$mediaStr .= $reqImg->media_id_string.',';
				}
				$count++;
			}
			$postfields['media_ids'] = substr($mediaStr, 0, -1);
		}
		
		
		$twitter = new TwitterAPIExchange($this->twKeys);
		$request = $twitter->buildOauth($url, $requestMethod)->setPostfields($postfields)->performRequest();
		
		$response = json_decode($request);
		
		if(isset($response->errors))
		{
			$errorMsg = $response->errors[0]->code.' ('.$response->errors[0]->message.')';
			$this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('msocial_error_posting').' Twitter '.$errorMsg);
		}
	}
	
	/**
     * Загрузка изображений
     */
	public function uploadImg($file)
	{
		$file = file_get_contents(MODX_BASE_PATH.$file);
		$data = base64_encode($file);
		
		$url = 'https://upload.twitter.com/1.1/media/upload.json';
		$requestMethod = 'POST';
		
		$postfields = array(
            'media_data' => $data
        );
		$twitter = new TwitterAPIExchange($this->twKeys);
		$request = $twitter->buildOauth($url, $requestMethod)->setPostfields($postfields)->performRequest();
		
		$response = json_decode($request);
		
		return $response;
		
	}
}
?>