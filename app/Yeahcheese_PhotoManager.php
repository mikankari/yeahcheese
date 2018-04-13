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
     *  @return int                 追加した写真のID。失敗した場合は 0
     */
    public function addEventPhoto(int $eventId, string $tmpName): int
    {
        $result = $this->db->execute('INSERT INTO photos (event_id) VALUES (?)', [
            $eventId,
        ]);

        if (! $result) {
            return 0;
        }

        $insertId = $this->db->getOne('SELECT max(id) FROM photos');

        move_uploaded_file($tmpName, self::UPLOAD_PATH . $insertId. '.jpg');

        return $insertId;
    }

    /**
     *  あるイベントの写真を削除する
     *
     *  @param  int     $eventId    対象とする写真のイベントのID
     *  @param  array   $photos     対象とする写真のIDの配列
     *  @return array               削除した写真のIDの配列。対象とする写真のIDの配列と同等です。失敗した場合は空の配列
     */
    public function removeEventPhotos(int $eventId, array $photos): array
    {
        $result = $this->db->execute('DELETE FROM photos where event_id = ? AND id IN (?)', [
            $eventId,
            implode(',', $photos),
        ]);

        if (! $result) {
            return [];
        }

        foreach ($photos as $photoId) {
            unlink(self::UPLOAD_PATH . $photoId . '.jpg');
        }

        return $photos;
    }
}
