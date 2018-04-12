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
    public function prepare()
    {
        if ($this->action_form->validate() > 0) {
            return 'event_login';
        }

        return null;
    }

    public function perform()
    {
        return null;
    }
}
