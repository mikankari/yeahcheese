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

    function addUserEvent($userId, $formVars){
        $result = $this->db->execute('insert into events (user_id, name, hash, publish_at, publish_end_at) values (?, ?, ?, ?, ?)', [
            $userId,
            uniqid(),
            $formVars['name'],
            $formVars['publish_at'],
            $formVars['publish_end_at'],
        ]);
        var_dump($this->db->db->errorMsg());

        if(! $result){
            return false;
        }

        $insertId = $this->db->getOne('select max(id) from events');

        return $insertId;
    }

    function editUserEvent($userId, $eventId, $formVars){
        $result = $this->db->execute('update events set name = ?, publish_at = ?, publish_end_at = ? where id = ? and user_id = ?', [
            $formVars['name'],
            $formVars['publish_at'],
            $formVars['publish_end_at'],
            $eventId,
            $userId,
        ]);

        if(! $result){
            return false;
        }

        return $eventId;
    }
}
?>
