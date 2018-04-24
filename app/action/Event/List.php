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
        $publishAtText = [];
        $statusLabel = [];
        $photosCount = [];
        foreach ($events as $item) {
            $publishAtText[$item['id']] = Yeahcheese_EventManager::getPublishAtText($this->user['id'], $item['publish_start_at'], $item['publish_end_at']);
            $statusLabel[$item['id']] = Yeahcheese_EventManager::getStatusLabel($item['publish_start_at'], $item['publish_end_at']);
            $photosCount[$item['id']] = count($photoManager->getEventPhotos($item['id']));
        }

        $this->action_form->setAppNE('publishAtText', $publishAtText);
        $this->action_form->setAppNE('statusLabel', $statusLabel);
        $this->action_form->setApp('photosCount', $photosCount);

        return 'event_list';
    }
}
