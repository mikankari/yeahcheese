<?php
/**
 * Yeahcheese_PhotoManager.php
 *
 * @author {$author}
 * @package Yeahcheese
 */

class Yeahcheese_PhotoManager extends Ethna_AppManager
{
    /**
     *  アップロードされた写真を保存するパス
     */
    const UPLOAD_PATH = '../www/upload/photos/';
    const UPLOAD_URL = './upload/photos/';

    /**
     *  あるイベントに投稿されたすべての写真を取得する
     *
     *  @param  int     $eventId    対象とするイベントのID
     *  @return array               写真の配列
     */
    public function getEventPhotos(int $eventId): array
    {
        return $this->db->getAll('SELECT id FROM photos WHERE event_id = ?', [
            $eventId,
        ]);
    }

    /**
     *  あるイベントに写真を追加する
     *
     *  @param  int     $eventId    対象とするイベントのID
     *  @param  string  $tmp_name   サーバが一時的にアップロードしたファイルのパス
     *  @return bool                成功したらTRUE
     */
    public function addEventPhoto(int $eventId, string $tmpName): bool
    {
        $result = $this->db->query('INSERT INTO photos (event_id) VALUES (?)', [
            $eventId,
        ]);

        if ($result) {
            $insertId = $this->db->getOne('SELECT max(id) FROM photos');

            move_uploaded_file($tmpName, UPLOAD_PATH . $insertId. '.jpg');
        }

        return (boolean) $result;
    }
}
