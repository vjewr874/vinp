<?php
/**
 * Project: thuvien.
 * File: registerModel.php.
 * Author: TuyenHH
 * Email: tuyenhh@xiao.vn
 * Create Date: 10:00 - 28/08/2014
 * Website: www.xiao.vn
 */
Class registerModel extends baseModel
{
    public function register($xid,$username,$password,$email)
    {
        global $db;
        $db->query("INSERT INTO xdata_account(xid,username,password,email,usergroup) VALUES ('".$xid."','".$username."','".$password."','".$email."')");
    }
	public function insertInfo($xid,$firstname,$name,$othername,$birthday,$sex,$diachi,$quequan_tinh)
    {
        global $db;
        $db->query("INSERT INTO xdata_info(xid,firstname,name,othername,birthday,sex,diachi,quequan_tinh) VALUES ('".$xid."','".$firstname."','".$name."','".$othername."','".$birthday."','".$sex."','".$diachi."','".$quequan_tinh."')");
    }
	public function updateinfo($xid,$username,$password,$email,$firstname,$lastname,$gender,$dob,$about)
    {

        global $db;
        $db->query("INSERT INTO xdata_account(xid,username,password,email,xgroup)VALUES ('".$xid."','".$username."','".md5($password)."','".$email."','2268430')");
        $db->query("INSERT INTO xdata_info(xid,firstname,name,birthday,sex,slogan)VALUES ('".$xid."','".$firstname."','".$lastname."','".$dob."','".$gender."','".$about."')");
    }
}