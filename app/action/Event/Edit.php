<?php
/**
 *  Event/Edit.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_Form_EventEdit extends Yeahcheese_ActionForm
{
    public $form = [
        'event_id' =>[
            'type'      =>  VAR_TYPE_INT,
            'required'  =>  false,  // 未入力は新規イベントとする
        ],
    ];
}

class Yeahcheese_Action_EventEdit extends Yeahcheese_ActionClass
{
    public function prepare()
    {
        return null;
    }

    public function perform()
    {
        $userId = 1;    // 未実装のため仮データ
        $eventId = $this->action_form->get('event_id');

        if ($eventId) {
            $eventManager = $this->backend->getManager('event');
            $current = $eventManager->getLoginEvent($userId, $eventId);

            $this->action_form->setApp('eventId', $eventId);
            $this->action_form->setApp('name', $current['name']);
            $this->action_form->setApp('password', $current['password']);
            $this->action_form->setApp('publishStartAt', $current['publish_start_at']);
            $this->action_form->setApp('publishEndAt', $current['publish_end_at']);

            $photoManager = $this->backend->getManager('photo');
            $photos = $photoManager->getEventPhotos($eventId);

            $this->action_form->setApp('photos', $photos);
            $this->action_form->setApp('photosBaseUrl', Yeahcheese_PhotoManager::UPLOAD_URL);
        }

        return 'event_edit';
    }
}
