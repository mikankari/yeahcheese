<?php
/**
 *  Event/Edit/Delete.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_Form_EventEditDelete extends Yeahcheese_ActionForm
{
    public $form = [
        'event_id' => [
            'type'      => VAR_TYPE_INT,
            'required'  => true,
            'form_type' => FORM_TYPE_HIDDEN,
        ],
        'photos' => [
            'name'      => '写真',
            'type'      => [VAR_TYPE_INT],
            'required'  => true,
        ],
    ];

}

class Yeahcheese_Action_EventEditDelete extends Yeahcheese_ActionClass
{
    public function prepare()
    {
        if ($this->action_form->validate() > 0) {
            return 'event_edit';
        }

        return null;
    }

    public function perform()
    {
        return null;
    }
}
