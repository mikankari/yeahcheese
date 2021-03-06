<?php
// vim: foldmethod=marker
/**
 *  Yeahcheese_ActionClass.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

// {{{ Yeahcheese_ActionClass
/**
 *  action execution class
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 *  @access     public
 */
class Yeahcheese_ActionClass extends Ethna_ActionClass
{
    protected $user = [];

    /**
     *  authenticate before executing action.
     *
     *  @access public
     *  @return string  Forward name.
     *                  (null if no errors. false if we have something wrong.)
     */
    public function authenticate()
    {
        $requiredLogin = [
            'event_edit',
            'event_edit_execute',
            'event_edit_delete',
            'event_list',
            'user_index',
            'user_login_revoke',
        ];

        $current = $this->backend->controller->getCurrentActionName();

        $userManager = $this->backend->getManager('user');
        $this->user = $userManager->getUser();

        if (in_array($current, $requiredLogin) && ! $this->user) {
            http_response_code(403);

            return 'error403';
        }

        $this->action_form->setApp('user', $this->user);

        return null;
    }

    /**
     *  Preparation for executing action. (Form input check, etc.)
     *
     *  @access public
     *  @return string  Forward name.
     *                  (null if no errors. false if we have something wrong.)
     */
    public function prepare()
    {
        return parent::prepare();
    }

    /**
     *  execute action.
     *
     *  @access public
     *  @return string  Forward name.
     *                  (we does not forward if returns null.)
     */
    public function perform()
    {
        return parent::perform();
    }
}
// }}}

