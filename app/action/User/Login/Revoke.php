<?php
/**
 *  User/Login/Revoke.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_Action_UserLoginRevoke extends Yeahcheese_ActionClass
{
    public function prepare()
    {
        return null;
    }

    public function perform()
    {
        $userManager = $this->backend->getManager('user');
        $userManager->logout();

        header('Location: ?action_user_login=true');

        return null;
    }
}
