<?php

namespace vii\components;

class BitrixAPIConnect
{
    private static $expires_in = null;
	/**
     * @var String Domain website
     */
	private $domain = 'https://bitrix24.net.vn';

	/**
     * @var String Application id
     */
	private $application_id = 'local.59141e673713c7.76259301';

	/**
     * @var String Application secret
     */
	private $application_secret = 'l04TQYdZDS5l1EhK4rgnTCc0bJ5v5Otc8PvncIPxcakrAFTjiN';

	/**
     * @var String Authentication refresh code
     */
	private $authentication_refresh_code = 'pyu4je4w96ono3jhu5zguwsmwwxggdaw';

	/**
     * @var String Link connect api
     */
	private $url_api = '';

	private static $_instance = null;

	/**
     * @return \app\packages\contact\models\Contact
     */
    public static function getInstance()
    {
        if (null === static::$_instance) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }

	public function __construct() {
        $access_token = 'vjx4oi93v0r7b6r7kbql9iusrq4b5uf7';
        if (null === static::$expires_in OR time() >= static::$expires_in){
		  $access_token = json_decode($this->generateAuthorizationToken());
          static::$expires_in = time() + 3600;
        }

		$this->url_api = $this->domain . '/rest/{action}?auth=' . $access_token->access_token;
	}

	/**
     * Create connection string to bitrix
     * @param string $action Action taken in bitrix
     *
     * @throws InvalidConfigException
     * @return string
     */
	public function connection($action) {
		$this->url_api = str_replace('{action}', $action, $this->url_api);

		return $this->url_api;
	}

	/**
     * Function generate token authorization in bitrix
     *
     * @throws InvalidConfigException
     * @return string
     */
	private function generateAuthorizationToken() {
		$urlGetToken = $this->domain . '/pub/token/?grant_type=refresh_token&client_id=' . $this->application_id . '&client_secret=' . $this->application_secret . '&refresh_token=' . $this->authentication_refresh_code . '&scope=granted_permission&redirect_uri=app_URL';

        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $urlGetToken); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($ch, CURLOPT_ENCODING, "");
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    # required for https urls

		$response = curl_exec($ch);

		if(!$response){
			die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
		}

		curl_close($ch);

		return $response;
	}
}