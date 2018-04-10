<?php
/**
 * Yeahcheese_PhotoManager.php
 *
 * @author {$author}
 * @package Yeahcheese
 */

/**
 * Yeahcheese_PhotoManager
 *
 * @author {$author}
 * @access public
 * @package Yeahcheese
 */
class Yeahcheese_PhotoManager extends Ethna_AppManager
{
    function getEventPhotos($event_id){
        $photos = $this->db->getAll('select id from photos where event_id = ' . $event_id);

        return $photos;
    }

    function addEventPhoto($event_id, $tmp_name){
        $result = $this->db->query('insert into photos (event_id) values (' . $event_id . ')');

        if($result){
            $insert_id = $this->db->getOne('select max(id) from photos');

            move_uploaded_file($tmp_name, '../www/upload/photos/' . $insert_id. '.jpg');
        }

        return (boolean) $result;
    }
}
?>
