<?php
/**
 *  Event/Show.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_Form_EventShow extends Yeahcheese_ActionForm
{
    public $form = [
        'event_id' => [
            'type' => VAR_TYPE_INT,
            'required' => true,
        ],
    ];
}

class Yeahcheese_Action_EventShow extends Yeahcheese_ActionClass
{
    private $eventId = null;

    public function prepare()
    {
        if ($this->action_form->validate() > 0) {
            return 'error404';
        }

        $this->eventId = $this->action_form->get('event_id');

        return null;
    }

    public function perform()
    {
        $eventManager = $this->backend->getManager('event');
        $current = $eventManager->getEvent($this->eventId);

        $this->action_form->setApp('event_id', $this->eventId);
        $this->action_form->setApp('name', $current['name']);
        $this->action_form->setApp('publish_start_at', $current['publish_start_at']);
        $this->action_form->setApp('publish_end_at', $current['publish_end_at']);

        $photoManager = $this->backend->getManager('photo');
        $photos = $photoManager->getEventPhotos($this->eventId);

        $this->action_form->setApp('photos', $photos);
        $this->action_form->setApp('photos_base_url', Yeahcheese_PhotoManager::UPLOAD_URL);

        return 'event_show';
    }
}
