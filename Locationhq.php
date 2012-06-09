<?php

/**
 * LocationHq.com API Wrapper
 * @author Aizuddin Manap <aizuddinmanap@gmail.com>
 */

Class Locationhq {
	protected $api_key = '';
	protected $username = '';
	protected $ip_address = '';
	protected $debug = false;

	public function __construct($config = array())
    {
        foreach ($config as $key => $val) {
			if (isset($this->$key)) {
				$this->$key = $val;
			}
		}
    }

	public function get_result()
	{
		$ch = curl_init('http://api.locatorhq.com/v2/?user=' . $this->username . '&key='. $this->api_key . '&format=json&ip=' . $this->ip_address);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_BUFFERSIZE, 4096);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 25);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

		if (curl_error($ch) != '') {
			if ($this->debug) {
				return curl_error($ch);
			} else {
				return false;
			}			
		} else {
			return json_decode(curl_exec($ch));
			
			curl_close($ch);	
		}
	}

	public function get_country()
	{
		$data = $this->get_result();

		return isset($data->countryCode) ? $data->countryCode : false;
	}
}