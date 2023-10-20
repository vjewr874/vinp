<?php

Class game{


    /*
     * @Variables array
     * @access public
     */
    private static $instance;

    /**
     *
     * @constructor
     *
     * @access public
     *
     * @return void
     *
     */
	public static function getInstance() {
        if (!self::$instance)
        {
            self::$instance = new game();
        }
        return self::$instance;
    }
    function __construct() {

    }
	public function get_pending_transaction($uid)
	{
		global $db;
		$db->query("SELECT sum(trans_amount) as pending FROM portal_transactions WHERE uid = '".$uid."' AND trans_status = 0");
		return $db->fetch_object(true)->pending;
	}
	
}