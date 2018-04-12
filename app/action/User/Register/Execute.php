<?php
/**
 *  User/Register/Execute.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_Form_UserRegisterExecute extends Yeahcheese_ActionForm
{
    public $form = [
        'name' => [
            'name'      => '表示名',
            'type'      => VAR_TYPE_STRING,
            'required'  => true,
        ],
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
        'password_confirm' => [
            'name'      => 'パスワードの確認',
            'type'      => VAR_TYPE_STRING,
            'form_type' => FORM_TYPE_PASSWORD,
            'required'  => true,
            'custom'    => 'checkSame',
        ],
    ];

    /**
     *  フィールド名から _confirm を除いたフィールドと除かないフィールドが一致するか確認する
     *
     *  @param  string  $name   _confirm を含むname属性値
     */
    public function checkSame(string $name): void
    {
        $target = substr($name, 0, strpos($name, '_confirm'));

        if ($this->form_vars[$target] !== $this->form_vars[$name]) {
            $this->action_error->add($name, '{form}は' . $this->getName($target) . 'と一致しません');
        }
    }
}

class Yeahcheese_Action_UserRegisterExecute extends Yeahcheese_ActionClass
{
    public function prepare()
    {
        if ($this->action_form->validate() > 0) {
            return 'user_register';
        }

        return null;
    }

    public function perform()
    {
        return null;
    }
}
