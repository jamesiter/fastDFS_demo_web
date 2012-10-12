<?php
	require dirname(__FILE__) . '/../config/function.php';
	if ($_FILES["file"]["error"] > 0) {
		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
	}
	else {
		echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		echo "Type: " . $_FILES["file"]["type"] . "<br />";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
		$origin_file_name = $_FILES["file"]["name"];
		$fdfs = new FastDFS();
		$file_info = $fdfs->storage_upload_by_filename($_FILES["file"]["tmp_name"],'jpeg');
		var_dump($file_info);
		$group_name = $file_info['group_name'];
		$str_filename = del_backslash($file_info['filename']);
		$h_domain = $group_name . ':' . $str_filename;
		$l_r = new Redis();
		$l_r->connect("localhost",2301,1);
		$l_r->hset($h_domain,"origin_name",$origin_file_name);
		$l_r->close();
	}
?>
