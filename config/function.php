<?php
	$maps_path = dirname(__FILE__) . '/maps.ini';
	$maps = parse_ini_file($maps_path);
	$today = date("Y-m-d");
	$mirco_sec = get_mirco();
	$now_time = date("H:i:s");
	$ts = time();

	function get_mirco() {
		list($usec, $sec) = explode(" ", microtime());
		return  $sec . substr(explode(".", $usec)[1],0,-2);
	}

	function del_backslash($origin_name) {
		$pattern = '/(M\d+)\/(\d+)\/(\d+)\/(.*)\..*/i';
		$replacement = '$1$2$3$4';
		return preg_replace($pattern,$replacement,$origin_name);
	}

	function restore_path($str) {
		$pattern = '/(M\d{2})(\d{2})(\d{2})(.*)/i';
		$replacement = '$1/$2/$3/$4';
		return preg_replace($pattern,$replacement,explode(":",$str)[1]);
	}

	function get_group($str) {
		return explode(":",$str)[0];
	}

?>
