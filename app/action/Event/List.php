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

        $photoManager = $this->backend->getManager('photo');
        $photosCount = [];
        foreach ($events as $item) {
            $photosCount[$item['id']] = count($photoManager->getEventPhotos($item['id']));
        }

        $this->action_form->setApp('photosCount', $photosCount);

        return 'event_list';
    }
}
