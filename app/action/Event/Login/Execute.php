<?php
/**
 *  Event/Login/Execute.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_Form_EventLoginExecute extends Yeahcheese_ActionForm
{
    public $form = [
        'password' => [
            'type'      =>  VAR_TYPE_STRING,
            'form_type' =>  FORM_TYPE_PASSWORD,
            'name'      =>  '認証キー',
            'required'  =>  true,
        ],
    ];
}

class Yeahcheese_Action_EventLoginExecute extends Yeahcheese_ActionClass
{
    private $eventId = false;

    public function prepare()
    {
        if ($this->action_form->validate() > 0) {
            return 'event_login';
        }

        $eventManager = $this->backend->getManager('event');

        $this->eventId = $eventManager->login($this->action_form->get('password'));
        if (! $this->eventId) {
            $this->action_error->add('password', '{form} が正しくありません', E_FORM_INVALIDVALUE);

            return 'event_login';
        }

        $event = $eventManager->getLoginEvent(0, $this->eventId);
        if (! $event) {
            $this->action_error->add('password', 'イベントは公開期限外です', E_FORM_INVALIDVALUE);

            return 'event_login';
        }

        return null;
    }

    public function perform()
    {
        header('Location: ?action_event_show=true&event_id=' . $this->eventId);

        return null;
    }
}
