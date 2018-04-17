<?php
/**
 *  User/Index.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_Action_UserIndex extends Yeahcheese_ActionClass
{
    public function prepare()
    {
        return null;
    }

    public function perform()
    {
        $this->action_form->setApp('email', $this->user['email']);

        return 'user_index';
    }
}
