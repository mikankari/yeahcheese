<?php
/**
 *  Event/Edit.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_Form_EventEdit extends Yeahcheese_ActionForm
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
            'max'       =>  Yeahcheese_Form_EventEdit::PHOTO_MAX_SIZE * 1024,
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
        $target = 'publish_at';

        $start = new DateTime($this->form_vars[$target]);
        $end = new DateTime($this->form_vars[$name]);

        if ($end->getTimestamp() < $start->getTimestamp()) {
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
            if (!in_array($photo['type'], Yeahcheese_Form_EventEdit::PHOTO_ACCEPT_TYPES, true)) {
                $this->action_error->add($name, '{form} はアップロードできるフォーマットではありません', E_FORM_INVALIDVALUE);
            }
        }
    }
}

class Yeahcheese_Action_EventEdit extends Yeahcheese_ActionClass
{

    private $userId = null;

    private $eventId = null;

    public function prepare()
    {
        $this->userId = 1;  // 未実装のため仮データ
        $this->eventId = $this->action_form->get('event_id');

        // イベント編集フォームが送られていない場合、またはバリデーションで失敗した場合はフォームを表示する
        $isSendForm = $this->action_form->get('name') !== null;
        if (!$isSendForm || $isSendForm && $this->action_form->validate() > 0) {

            // リンク元から event_id が送られていない場合は新規イベントのフォームを表示する
            if ($this->eventId) {
                $eventManager = $this->backend->getManager('event');
                $current = $eventManager->getEvent($this->eventId);

                $this->action_form->setApp('event_id', $this->eventId);
                $this->action_form->setApp('name', $current['name']);
                $this->action_form->setApp('hash', $current['hash']);
                $this->action_form->setApp('publish_at', $current['publish_at']);
                $this->action_form->setApp('publish_end_at', $current['publish_end_at']);
            }

            return 'event_edit';
        }

        return null;
    }

    public function perform()
    {
        // フォームから event_id が送られていない場合は新規イベント
        $eventManager = $this->backend->getManager('event');
        if (! $this->eventId) {
            $this->eventId = $eventManager->addUserEvent($this->userId, $this->action_form->form_vars);
        } else {
            $eventManager->editUserEvent($this->userId, $this->eventId, $this->action_form->form_vars);
        }

        if ($this->action_form->get('photo')[0]['error'] !== UPLOAD_ERR_NO_FILE) {
            foreach ($this->action_form->get('photos') as $photo) {
                $photoManager = $this->backend->getManager('photo');
                $photoManager->addEventPhoto($this->eventId, $photo['tmp_name']);
            }
        }

        header('Location: ?action_event_show=true&event_id=' . $this->eventId);

        return null;
    }
}
