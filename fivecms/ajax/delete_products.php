<?php
	session_start();
	require_once('../../api/Fivecms.php');
	$fivecms = new Fivecms();
	
	$result = "delete_error";
	
	try {
		$fivecms->db->truncate_table($fivecms->config->db_prefix."images");
		usleep(50000);
		$fivecms->db->truncate_table($fivecms->config->db_prefix."options");
		usleep(50000);
		$fivecms->db->truncate_table($fivecms->config->db_prefix."products");
		usleep(50000);
		$fivecms->db->truncate_table($fivecms->config->db_prefix."products_categories");
		usleep(50000);
		$fivecms->db->truncate_table($fivecms->config->db_prefix."related_products");
		usleep(50000);
		$fivecms->db->truncate_table($fivecms->config->db_prefix."variants");
		usleep(50000);
		
		$originals_dir = $fivecms->config->root_dir.'files/originals/';
		$products_dir = $fivecms->config->root_dir.'files/products/';

    	@clean_dir($originals_dir);
    	usleep(50000);
    	@clean_dir($products_dir);
    	
		$result = "delete_success";
	} catch (Exception $e) {
		$result = "delete_error";
	}
	
	function clean_dir($path)
	{
		$path = rtrim($path, '/') . '/';
		$handle = opendir($path);
		for ($i = 0; false !== ($file = readdir($handle)); $i++)
			if ($file != "." and $file != "..") {
				$fullpath = $path . $file;
				if (is_dir($fullpath)) {
					clean_dir($fullpath);
					rmdir($fullpath);
				} else {
					unlink($fullpath);
				}
			}
		closedir($handle);
	}
	
	header("Content-type: application/json; charset=UTF-8");
	header("Cache-Control: must-revalidate");
	header("Pragma: no-cache");
	header("Expires: -1");	
	
	print json_encode($result);