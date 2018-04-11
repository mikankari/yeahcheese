<?php
/**
 *  Event/List.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_Action_EventList extends Yeahcheese_ActionClass
{
    public function prepare()
    {
        return null;
    }

    public function perform()
    {
        $userId = 1;    // 未実装のため仮データ

        $eventManager = $this->backend->getManager('event');
        $events = $eventManager->getUserEvents($userId);

        $this->action_form->setApp('events', $events);

        return 'event_list';
    }
}
