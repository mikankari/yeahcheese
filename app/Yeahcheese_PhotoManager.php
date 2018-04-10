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
}
?>
