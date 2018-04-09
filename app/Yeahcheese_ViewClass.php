<?php
// vim: foldmethod=marker
/**
 *  Yeahcheese_ViewClass.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

// {{{ Yeahcheese_ViewClass
/**
 *  View class.
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 *  @access     public
 */
class Yeahcheese_ViewClass extends Ethna_ViewClass
{
    /**#@+
     *  @access protected
     */

    /** @var  string  set layout template file   */
    protected $_layout_file = 'layout';

    /**#@+
     *  @access public
     */

    /** @var boolean  layout template use flag   */
    public $use_layout = true;

    /**
     *  set common default value.
     *
     *  @access protected
     *  @param  object  Yeahcheese_Renderer  Renderer object.
     */
    protected function _setDefault($renderer)
    {
    }

}
// }}}

