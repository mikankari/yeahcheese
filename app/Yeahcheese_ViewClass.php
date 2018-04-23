<?php
// vim: foldmethod=marker
/**
 *  Yeahcheese_ViewClass.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_ViewClass extends Ethna_ViewClass
{
    function getFormInput($name, $action, $params)
    {
        $af = $this->_getHelperActionForm($action, $name);
        if ($af === null) {
            return '';
        }

        $def = $af->getDef($name);
        if ($def === null) {
            return '';
        }

        if (isset($def['required']) && $def['required'] && ! is_array($def['type'])) {
            $params['required'] = '';
        }

        return parent::getFormInput($name, $action, $params);
    }

}

