<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Xiao
 * Date: 10/7/13
 * Time: 8:38 AM
 * To change this template use File | Settings | File Templates.
 */
Class tailieuModel extends baseModel
{
    public function get_sachtheotailieu($matailieu)
    {
        global $db;
        $db->query("SELECT * FROM xiaob_book WHERE matailieu='".$matailieu."'");
        return $db->fetch_object();

    }
	public function insertBook($bookname,$bookcat,$booksubj,$bookcontent,$bookimage,$bookpuber,$bookauthor,$bookyear,$bookpubdate,$bookgrade,$bookfile,$bookview,$bookdown,$bookscore,$bookprice,$bookstatus,$bookfeat)
	{
		global $db;
		$db->query("INSERT INTO xiaob_book(bookname,bookcat,booksubj,bookcontent,bookimage,bookpuber,bookauthor,bookyear,bookpubdate,bookgrade,bookfile,bookview,bookdown,bookscore,bookprice,bookstatus,bookfeat) VALUES('".$bookname."','".$bookcat."','".$booksubj."','".$bookcontent."','".$bookimage."','".$bookpuber."','".$bookauthor."','".$bookyear."','".$bookpubdate."','".$bookgrade."','".$bookfile."','".$bookview."','".$bookdown."','".$bookscore."','".$bookprice."','".$bookstatus."','".$bookfeat."')");
	}
}