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
        $eventManager = $this->backend->getManager('event');
        $events = $eventManager->getUserEvents($this->user['id']);

        $this->action_form->setApp('events', $events);

        $formatedPublishAt = [];
        foreach ($events as $item) {
            $formatedPublishAt[$item['id']] = Yeahcheese_EventManager::formatPublishAt($this->user['id'], $item['publish_start_at'], $item['publish_end_at']);
        }

        $this->action_form->setAppNE('formatedPublishAt', $formatedPublishAt);

        return 'event_list';
    }
}
