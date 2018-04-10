<?php
/**
 *  Event/Show.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

/**
 *  event_show Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Yeahcheese
 */
class Yeahcheese_Form_EventShow extends Yeahcheese_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
       /*
        *  TODO: Write form definition which this action uses.
        *  @see http://ethna.jp/ethna-document-dev_guide-form.html
        *
        *  Example(You can omit all elements except for "type" one) :
        *
        *  'sample' => array(
        *      // Form definition
        *      'type'        => VAR_TYPE_INT,    // Input type
        *      'form_type'   => FORM_TYPE_TEXT,  // Form type
        *      'name'        => 'Sample',        // Display name
        *
        *      //  Validator (executes Validator by written order.)
        *      'required'    => true,            // Required Option(true/false)
        *      'min'         => null,            // Minimum value
        *      'max'         => null,            // Maximum value
        *      'regexp'      => null,            // String by Regexp
        *
        *      //  Filter
        *      'filter'      => 'sample',        // Optional Input filter to convert input
        *      'custom'      => null,            // Optional method name which
        *                                        // is defined in this(parent) class.
        *  ),
        */
    );

    /**
     *  Form input value convert filter : sample
     *
     *  @access protected
     *  @param  mixed   $value  Form Input Value
     *  @return mixed           Converted result.
     */
    /*
    protected function _filter_sample($value)
    {
        //  convert to upper case.
        return strtoupper($value);
    }
    */
}

/**
 *  event_show action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Yeahcheese
 */
class Yeahcheese_Action_EventShow extends Yeahcheese_ActionClass
{
    /**
     *  preprocess of event_show Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {
        /**
        if ($this->af->validate() > 0) {
            // forward to error view (this is sample)
            return 'error';
        }
        $sample = $this->af->get('sample');
        */
        return null;
    }

    /**
     *  event_show action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        $event_id = 1;

        $photoManager = $this->backend->getManager('photo');
        $photos = $photoManager->getEventPhotos($event_id);

        $this->action_form->setApp('photos', $photos);

        return 'event_show';
    }
}
