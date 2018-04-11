<?php
/**
 *  Event/Edit.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

/**
 *  event_edit Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Yeahcheese
 */
class Yeahcheese_Form_EventEdit extends Yeahcheese_ActionForm
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
            'type'      =>  VAR_TYPE_INT,
            'form_type' =>  FORM_TYPE_HIDDEN,
        ],
        'name' => [
            'type'      =>  VAR_TYPE_STRING,
            'name'      =>  'イベント名',
            'required'  =>  true,
        ],
        'publish_at' => [
            'type'      =>  VAR_TYPE_DATETIME,
            'name'      =>  '公開期間の開始',
            'required'  =>  true,
            'regexp'    =>  '/^\d{4}(-\d{2}){2} \d{2}(:\d{2}){2}$/'
        ],
        'publish_end_at' => [
            'type'      =>  VAR_TYPE_DATETIME,
            'name'      =>  '公開期間の終了',
            'required'  =>  true,
            'regexp'    =>  '/^\d{4}(-\d{2}){2} \d{2}(:\d{2}){2}$/',
            'custom'    =>  'validatePublishEndAt',
        ],
        'photos' => [
            'type'      =>  [VAR_TYPE_FILE],
            'form_type' =>  FORM_TYPE_FILE,
            'name'      =>  '写真',
            'max'       =>  5 * 1024,
            'custom'    =>  'validatePhotos',
        ]
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

    function validatePublishEndAt($name){
        $target = 'publish_at';
        if(strtotime($this->form_vars[$name]) < strtotime($this->form_vars[$target])){
            $this->action_error->add($name, '{form} が ' . $this->getName($target) . 'を超えています', E_FORM_INVALIDVALUE);
        }
    }

    function validatePhotos($name){
        $accept_types = [
            'image/jpeg',
        ];

        if($this->form_vars[$name][0]['error'] === UPLOAD_ERR_NO_FILE){
            return;
        }

        foreach($this->form_vars[$name] as $photo){
            if(!in_array($photo['type'], $accept_types, true)){
                $this->action_error->add($name, '{form} のフォーマットは JPEG 形式ではありません', E_FORM_INVALIDVALUE);
            }
        }
    }
}

/**
 *  event_edit action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Yeahcheese
 */
class Yeahcheese_Action_EventEdit extends Yeahcheese_ActionClass
{

    private $user_id = null;
    private $event_id = null;

    /**
     *  preprocess of event_edit Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {
        $this->user_id = 1;
        $this->event_id = $this->action_form->get('event_id');

        $is_send_form = $this->action_form->get('name') !== null;
        if (!$is_send_form || $is_send_form && $this->action_form->validate() > 0) {

            if($this->event_id){
                $eventManager = $this->backend->getManager('event');
                $current = $eventManager->getEvent($this->event_id);

                $this->action_form->setApp('event_id', $this->event_id);
                $this->action_form->setApp('name', $current['name']);
                $this->action_form->setApp('hash', $current['hash']);
                $this->action_form->setApp('publish_at', $current['publish_at']);
                $this->action_form->setApp('publish_end_at', $current['publish_end_at']);
            }

            return 'event_edit';
        }

        return null;
    }

    /**
     *  event_edit action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        $eventManager = $this->backend->getManager('event');
        if(! $this->event_id){
            $this->event_id = $eventManager->addUserEvent($this->user_id, $this->action_form->form_vars);
        }else{
            $eventManager->editUserEvent($this->user_id, $this->event_id, $this->action_form->form_vars);
        }

        if($this->action_form->get('photo')[0]['error'] !== UPLOAD_ERR_NO_FILE){
            foreach($this->action_form->get('photos') as $photo){
                $photoManager = $this->backend->getManager('photo');
                $photoManager->addEventPhoto($this->event_id, $photo['tmp_name']);
            }
        }

        header('Location: ?action_event_show=true&event_id=' . $this->event_id);

        return null;
    }
}
