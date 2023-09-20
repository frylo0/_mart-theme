<?php
/*
 * Author:  Fedor Nikonov (fritylo)
 * Date:    Sun Mar 19 2023 6:04:11 PM
 */

class UrlQuery {
	public $url;
	private $query;

	public function __construct(string $url = '') {
		$url = $url !== ''
			? $url 
			: (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
				. "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		$this->url = $url;
		$this->refresh();
	}

	public function refresh() {
		$this->query = self::decode($this->url);
	}

	public function reset() {
		$this->query = [];
	}

	public function set($key, $value) {
		$this->query[$key] = $value;
	}

	public function get($key) {
		if ($this->has($key)) {
			return $this->query[$key];
		} else {
			return null;
		}
	}

	public function has($key) {
		return isset($this->query[$key]);
	}

	public function toString() {
		$query_string = '?';
		foreach ($this->query as $prop => $value)
			$query_string .= "$prop=$value&";
		$query_string = substr($query_string, 0, -1);

		return $query_string;
	}

	private static function decode(string $url) {
		$actual_link = $url;
		$query_start_pos = strrpos($actual_link, '?');
		if ($query_start_pos === false)
			$query_start_pos = mb_strlen($actual_link) - 1;
		$actual_query = substr($actual_link, $query_start_pos + 1);

		$query_parts = [];
		if ($actual_query)
			$query_parts = explode('&', $actual_query);
		$query = [];
		foreach ($query_parts as $query_part) {
			if (strpos($query_part, '=') !== false) {
				$split = explode('=', $query_part);
				$query[$split[0]] = urldecode($split[1]);
			} else {
				$query[$query_part] = '';
			}
		}

		return $query;
	}
}

?>
