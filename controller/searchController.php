<?php
/**
 * Project: thuvien.
 * File: searchController.php.
 * Author: Ken Zaki
 * Email: kenzaki@xiao.vn
 * Create Date: 17:08 - 21/10/2013
 * Website: www.xiao.vn
 */
Class searchController extends baseController
{
    public function index()
    {

    }
    public function tag($para)
    {
        $keyword = $para[1];
        $this->view->data['keyword'] = $keyword;
        $list_tag = explode("-", $keyword);
        $l2l[] = null;
        $listid[] = null;
        for($i = 0; $i < count($list_tag);$i++)
        {
            global $db;
            $db->query("SELECT bookid FROM xiaob_book WHERE bookname like '%".$list_tag[$i]."%'");
            $l2l[$i] = $db->fetch_object();
        }
        for($j = 0;$j < count($l2l);$j++)
        {
            foreach($l2l[$j] as $ls)
            {
                array_push($listid,$ls->bookid);
            }
        }

        //=============================================================//
        $spp = 11;
        $page = 1;
        if(isset($_GET['page']) && $_GET['page'] != "")
        {
            $page = $_GET['page'];
        }
        $cp = $page - 1;
        $sodu_lieu = count($listid);
        $sotrang = $sodu_lieu/$spp;
        $slist = array_slice($listid,$cp*$spp,$spp);
        $this->view->data['listid'] = $slist;
        $this->view->data['count'] = $sodu_lieu;
        $this->view->data['sotrang'] = $sotrang;
        $this->view->show('tags');
    }
}