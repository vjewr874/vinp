<?php
Class placeModel extends baseModel
{
    public function get_place_info($placeid)
    {
        global $db;
        $db->query("SELECT * FROM sgt_tour_place WHERE id ='".$placeid."'");
        return $db->fetch_object(true);

    }
}