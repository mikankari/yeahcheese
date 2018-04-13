<?php
/**
 *  Event/Edit/Execute.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_Form_EventEditExecute extends Yeahcheese_ActionForm
{
    /**
     *  アップロードできる１つの写真あたりの最大MBサイズ
     */
    const PHOTO_MAX_SIZE = 5;

    /**
     *  アップロードできる写真のMIMEタイプ
    */
    const PHOTO_ACCEPT_TYPES = [
        'image/jpeg',
    ];

    public $form = [
        'event_id' => [
            'type'      =>  VAR_TYPE_INT,
            'form_type' =>  FORM_TYPE_HIDDEN,
            'required'  =>  false,  // 未入力は新規イベントとする
        ],
        'name' => [
            'type'      =>  VAR_TYPE_STRING,
            'name'      =>  'イベント名',
            'required'  =>  true,
        ],
        'publish_start_at' => [
            'type'      =>  VAR_TYPE_DATETIME,
            'name'      =>  '公開期間の開始',
            'required'  =>  true,
            'regexp'    =>  '/^\d{4}(-\d{2}){2} \d{2}(:\d{2}){2}$/',
        ],
        'publish_end_at' => [
            'type'      =>  VAR_TYPE_DATETIME,
            'name'      =>  '公開期間の終了',
            'required'  =>  true,
            'regexp'    =>  '/^\d{4}(-\d{2}){2} \d{2}(:\d{2}){2}$/',
            'custom'    =>  'checkPublishEndAt',
        ],
        'photos' => [
            'type'      =>  [VAR_TYPE_FILE],
            'form_type' =>  FORM_TYPE_FILE,
            'name'      =>  '写真',
            'required'  =>  false,  // イベントのみ編集を考慮して必須としていません
            'max'       =>  self::PHOTO_MAX_SIZE * 1024,
            'custom'    =>  'checkPhotos',
        ],
    ];

    /**
     *  終了の日時が開始の日時より後になっているか確認する
     *
     *  @param  string  $name   終了の日時のname属性値
     */
    public function checkPublishEndAt(string $name): void
    {
        // 開始の日時のname属性値
        $target = 'publish_start_at';

        $start = new DateTime($this->form_vars[$target]);
        $end = new DateTime($this->form_vars[$name]);

        if ($end < $start) {
            $this->action_error->add($name, '{form} が ' . $this->getName($target) . 'を超えています', E_FORM_INVALIDVALUE);
        }
    }

    /**
     *  写真が追加可能なファイルか確認する
     *
     *  @param  string  $name   写真のname属性値
     */
    public function checkPhotos(string $name): void
    {
        // 写真が送られていなかったら何もしない
        if ($this->form_vars[$name][0]['error'] === UPLOAD_ERR_NO_FILE) {
            return;
        }

        foreach ($this->form_vars[$name] as $photo) {
            if (!in_array($photo['type'], self::PHOTO_ACCEPT_TYPES, true)) {
                $this->action_error->add($name, '{form} はアップロードできるフォーマットではありません', E_FORM_INVALIDVALUE);
            }
        }
    }
}

class Yeahcheese_Action_EventEditExecute extends Yeahcheese_ActionClass
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
        $userId = 1;  // 未実装のため仮データ
        $eventId = $this->action_form->get('event_id');

        $eventManager = $this->backend->getManager('event');

        if ($latest = ! $eventId) {
            $eventId = $eventManager->addUserEvent($userId, $this->action_form->form_vars);
        } else {
            $eventManager->editUserEvent($userId, $eventId, $this->action_form->form_vars);
        }

        if ($this->action_form->get('photos')[0]['error'] !== UPLOAD_ERR_NO_FILE) {
            foreach ($this->action_form->get('photos') as $photo) {
                $photoManager = $this->backend->getManager('photo');
                $photoManager->addEventPhoto($eventId, $photo['tmp_name']);
            }
        }

        if (! $latest) {
            header('Location: ?action_event_show=true&event_id=' . $eventId);

            return null;
        }

        $event = $eventManager->getLoginEvent($userId, $eventId);

        $this->action_form->setApp('event_id', $event['id']);
        $this->action_form->setApp('name', $event['name']);
        $this->action_form->setApp('password', $event['password']);
        $this->action_form->setApp('publish_start_at', $event['publish_start_at']);
        $this->action_form->setApp('publish_end_at', $event['publish_end_at']);

        return 'event_edit_execute';
    }
}
