<?php
/**
 *  User/Login/Execute.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_Form_UserLoginExecute extends Yeahcheese_ActionForm
{
    public $form = [
        'email' => [
            'name'      => 'メールアドレス',
            'type'      => VAR_TYPE_STRING,
            'required'  => true,
            'custom'    => 'checkMailaddress',
        ],
        'password' => [
            'name'      => 'パスワード',
            'type'      => VAR_TYPE_STRING,
            'form_type' => FORM_TYPE_PASSWORD,
            'required'  => true,
        ],
    ];
}

class Yeahcheese_Action_UserLoginExecute extends Yeahcheese_ActionClass
{
    public function prepare()
    {
        if ($this->action_form->validate() > 0) {
            return 'user_login';
        }

        return null;
    }

    public function perform()
    {
        return null;
    }
}
