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
        'event_id' => [
            'type' => VAR_TYPE_INT,
            'required' => true,
        ],
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

    private $event_id = null;

    /**
     *  preprocess of event_show Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {
        if($this->action_form->validate() > 0){
            return 'error404';
        }

        $this->event_id = $this->action_form->get('event_id');

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
        $eventManager = $this->backend->getManager('event');
        $current = $eventManager->getEvent($this->event_id);

        $this->action_form->setApp('event_id', $this->event_id);
        $this->action_form->setApp('name', $current['name']);
        $this->action_form->setApp('publish_at', $current['publish_at']);
        $this->action_form->setApp('publish_end_at', $current['publish_end_at']);

        $photoManager = $this->backend->getManager('photo');
        $photos = $photoManager->getEventPhotos($this->event_id);

        $this->action_form->setApp('photos', $photos);

        return 'event_show';
    }
}
