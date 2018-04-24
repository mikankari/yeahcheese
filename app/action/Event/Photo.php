<?php
/**
 *  Event/Photo.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_Form_EventPhoto extends Yeahcheese_ActionForm
{
    public $form = [
        'event_id' => [
            'type'     => VAR_TYPE_INT,
            'required'  => true,
        ],
        'photo_id' => [
            'type'      => VAR_TYPE_INT,
            'required'  => true,
        ],
    ];
}

class Yeahcheese_Action_EventPhoto extends Yeahcheese_ActionClass
{
    private $path = '';

    public function prepare()
    {
        if ($this->action_form->validate() > 0) {
            http_response_code(404);

            return 'error404';
        }

        if (strpos($_SERVER['HTTP_REFERER'], '/yeahcheese/?action_') === false) {
            http_response_code(403);

            return 'error403';
        }

        $eventId = $this->action_form->get('event_id');

        $eventManager = $this->backend->getManager('event');
        $event = $eventManager->getLoginEvent((int) $this->user['id'], $eventId);

        if (! $event) {
            http_response_code(403);

            return 'error403';
        }

        $photoId = $this->action_form->get('photo_id');

        $photoManager = $this->backend->getManager('photo');
        $this->path = $photoManager->getPhotoPath($eventId, $photoId);

        if (! $this->path) {
            http_response_code(403);

            return 'error403';
        }

        return null;
    }

    public function perform()
    {
        header('Content-Type: image/jpeg');
        readfile($this->path);

        return null;
    }
}
