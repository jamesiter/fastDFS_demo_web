<?php
	require dirname(__FILE__) . '/../config/function.php';
	$suffix = '.jpeg';
	$search_keyword = "group*";
	$l_r = new Redis();
	$l_r->connect("localhost",2301,1);
	$keys = $l_r->keys($search_keyword);
	var_dump($keys);
	echo '<br>';
	foreach ($keys as $key) {
		$group = get_group($key);
		$path_uri = restore_path($key);
		$token = fastdfs_http_gen_token($group . FDFS_FILE_ID_SEPERATOR . $path_uri . $suffix,$ts);
		$full_url = 'http://' . $maps[$group] . ':' . $maps['web_port'] . FDFS_FILE_ID_SEPERATOR . $path_uri . $suffix . '?token=' . $token . '&ts=' . $ts;
		echo '<a href="' . $full_url . '">' . $full_url . '</a><br>';
	}
	$l_r->close();
?>
