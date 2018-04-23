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

        $publishAtText = [];
        foreach ($events as $item) {
            $publishAtText[$item['id']] = Yeahcheese_EventManager::getPublishAtText($this->user['id'], $item['publish_start_at'], $item['publish_end_at']);
        }

        $this->action_form->setAppNE('publishAtText', $publishAtText);

        $statusLabel = [];
        foreach ($events as $item) {
            $statusLabel[$item['id']] = Yeahcheese_EventManager::getStatusLabel($item['publish_start_at'], $item['publish_end_at']);
        }
        $this->action_form->setAppNE('statusLabel', $statusLabel);

        $photosCount = [];
        foreach ($events as $item) {
            $photoManager = $this->backend->getManager('photo');
            $photos = $photoManager->getEventPhotos($item['id']);

            $photosCount[$item['id']] = count($photos);
        }

        $this->action_form->setApp('photosCount', $photosCount);

        return 'event_list';
    }
}
