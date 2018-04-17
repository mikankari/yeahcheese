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

        $email = $this->action_form->get('email');
        $password = $this->action_form->get('password');

        $userManager = $this->backend->getManager('user');
        $userId = $userManager->login($email, $password);
        if (! $userId) {
            $email_name = $this->action_form->getName('email');
            $password_name = $this->action_form->getName('password');

            $this->action_error->add(null, $email_name . 'または' . $password_name . 'が正しくありません', E_FORM_INVALIDVALUE);

            return 'user_login';
        }

        return null;
    }

    public function perform()
    {
        header('Location: ?action_user_index=true');

        return null;
    }
}
