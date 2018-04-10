<?php
/**
 * Yeahcheese_EventManager.php
 *
 * @author {$author}
 * @package Yeahcheese
 */

/**
 * Yeahcheese_EventManager
 *
 * @author {$author}
 * @access public
 * @package Yeahcheese
 */
class Yeahcheese_EventManager extends Ethna_AppManager
{
    function getUserEvents($user_id){
        $events = $this->db->getAll('select * from events where user_id = ' . $user_id);

        return $events;
    }
}
?>
