<?php
/**
 *  User/Index.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_Action_UserIndex extends Yeahcheese_ActionClass
{
    private $user = null;

    public function prepare()
    {
        $userManager = $this->backend->getManager('user');
        $this->user = $userManager->getUser();

        if (! $this->user) {
            http_response_code(403);

            return 'error403';
        }

        return null;
    }

    public function perform()
    {
        $this->action_form->setApp('email', $this->user['email']);

        return 'user_index';
    }
}
