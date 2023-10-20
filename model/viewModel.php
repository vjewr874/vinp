<?php
/**
 * Project: thuvien.
 * File: viewModel.php.
 * Author: Ken Zaki
 * Email: kenzaki@xiao.vn
 * Create Date: 19:25 - 12/10/2013
 * Website: www.xiao.vn
 */
Class viewModel extends baseModel
{
    public function getbook($bookid)
    {
        global $db;
        $db->query("SELECT * FROM xiaob_book WHERE bookid = '".$bookid."'");
        return $db->fetch_object($first_row = true);
    }
	public function getpuber($bookid)
    {
        global $db;
        $db->query("SELECT bookpuber FROM xiaob_book WHERE bookid = '".$bookid."'");
        return $db->fetch_object($first_row = true);
    }
	public function getnamepuber($bookpuber)
    {
        global $db;
        $db->query("SELECT (firstname+' '+name) AS name_puber FROM xdata_info WHERE xid = '".$bookpuber."'");
        return $db->fetch_object($first_row = true);
    }
}