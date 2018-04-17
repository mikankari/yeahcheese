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
    private $userId = null;

    public function prepare()
    {
        $userManager = $this->backend->getManager('user');
        $user = $userManager->getUser();

        if (! $user) {
            http_response_code(403);

            return 'error403';
        }

        $this->userId = $user['id'];

        return null;
    }

    public function perform()
    {
        $eventId = $this->action_form->get('event_id');

        if ($eventId) {
            $eventManager = $this->backend->getManager('event');
            $current = $eventManager->getLoginEvent($this->userId, $eventId);

            $this->action_form->setApp('event_id', $eventId);
            $this->action_form->setApp('name', $current['name']);
            $this->action_form->setApp('password', $current['password']);
            $this->action_form->setApp('publish_start_at', $current['publish_start_at']);
            $this->action_form->setApp('publish_end_at', $current['publish_end_at']);
        }

        return 'event_edit';
    }
}
