<?php
/**
 * Project: xvn.
 * File: config.php.
 * Author: Ken Zaki
 * Email: kenzaki@xiao.vn
 * Create Date: 2:28 PM - 7/30/13
 * Website: www.xiao.vn
 */
 header('Access-Control-Allow-Origin: *');
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
//=============== Custom configuration ==================//
define('DB_NAME', 'invest_data'); //database name
define('DB_USER', 'invest_data'); //database user
define('DB_PASSWORD', 'J3yCo2yP3'); //database password
define('DB_HOST', 'localhost'); //sql server

/*** define mailer ***/
define('MAIL_PROTOCOL', 'SMTP');
define('MAIL_HOST', 'smtp.zoho.com');
define('MAIL_ACC', '');
define('MAIL_PASS', '');
define('MAIL_PORT', 465);
define('MAIL_AUTH', true);
define('MAIL_SECURE', 'ssl');

/*** define Xiao SMS ***/
define('ZPAY_API_URL', 'https://api.vcfmedia.com');
define('ZPAY_API_KEY', 'key-u3issryeh2ljwlv1kjvmqzga3cbeqw3f');
define('ZPAY_API_SECRECT', 'ZX4R3BOYP6HJKIB1CFY800JYMMG512O7');


if(isset($_SESSION['testid']) && $_SESSION['testid'] == "1")
{
/*** define Theme ***/
	define('ThemeMaster', 'invest'); //Replace xpanel by your theme's name
}
else
{
	define('ThemeMaster', 'invest'); //Replace xpanel by your theme's name
}

/*** define site path ***/
define('XC_URL','https://investpro.asia/trade');
$siteurl = XC_URL;
/*** template path ***/
$template_path = XC_URL.'/template/'.ThemeMaster; //Warning: Don't change here
$upload_path = XC_URL.'/uploads';
$image_path = XC_URL.'/uploads/images';

/*** Set Application Name ***/
$app_name = 'Invest Pro';
?>