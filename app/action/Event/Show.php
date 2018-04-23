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
    private $event = null;

    public function prepare()
    {
        if ($this->action_form->validate() > 0) {
            http_response_code(404);

            return 'error404';
        }

        $this->eventId = $this->action_form->get('event_id');

        $eventManager = $this->backend->getManager('event');
        $this->event = $eventManager->getLoginEvent((int) $this->user['id'], $this->eventId);

        if (! $this->event) {
            http_response_code(403);

            return 'error403';
        }

        return null;
    }

    public function perform()
    {
        $this->action_form->setApp('eventId', $this->event['id']);
        $this->action_form->setApp('name', $this->event['name']);
        $this->action_form->setApp('publishStartAt', $this->event['publish_start_at']);
        $this->action_form->setApp('publishEndAt', $this->event['publish_end_at']);

        $publishAtText = Yeahcheese_EventManager::getPublishAtText(0, $this->event['publish_start_at'], $this->event['publish_end_at']);
        $this->action_form->setAppNE('publishAtText', $publishAtText);

        $photoManager = $this->backend->getManager('photo');
        $photos = $photoManager->getEventPhotos($this->eventId);

        $this->action_form->setApp('photos', $photos);
        $this->action_form->setApp('photosCount', count($photos));
        $this->action_form->setApp('photosBaseUrl', Yeahcheese_PhotoManager::UPLOAD_URL);

        return 'event_show';
    }
}
