<?php
/**
 *  Event/Login/Revoke.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_Action_EventLoginRevoke extends Yeahcheese_ActionClass
{
    public function prepare()
    {
        return null;
    }

    public function perform()
    {
        $eventManager = $this->backend->getManager('event');
        $eventManager->logout();

        header('Location: ?action_event_login=true');

        return null;
    }
}
