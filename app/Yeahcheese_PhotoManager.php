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
     *  @param  int     $userId     イベントを追加したユーザのID。イベントを追加したユーザと一致すれば写真を追加します
     *  @param  int     $eventId    対象とするイベントのID
     *  @param  array   $photos     サーバが一時的にアップロードしたファイルのパスの配列
     *  @return array               追加した写真のファイルのパスの配列。引数のファイルのパスの配列と同等です。失敗した場合は 0
     */
    public function addEventPhoto(int $userId, int $eventId, array $photos): array
    {
        $check = $this->db->getOne('SELECT id FROM events WHERE id = ? AND user_id = ?', [
            $eventId,
            $userId,
        ]);

        if (! $check) {
            return [];
        }

        if (count($photos) === 0) {
            return [];
        }

        $result = $this->db->execute('INSERT INTO photos (event_id) VALUES (?)' . str_repeat(', (?)', count($photos) - 1), array_fill(0, count($photos), $eventId));

        if (! $result) {
            return [];
        }

        $insertId = $this->db->getOne('SELECT lastval()') - count($photos);

        foreach ($photos as $tmpName) {
            $insertId++;
            move_uploaded_file($tmpName, self::UPLOAD_PATH . $insertId. '.jpg');
        }

        return $photos;
    }

    /**
     *  あるイベントの写真を削除する
     *
     *  @param  int     $userId     イベントを追加したユーザのID。イベントを追加したユーザと一致すれば写真を削除します
     *  @param  int     $eventId    対象とする写真のイベントのID
     *  @param  array   $photos     対象とする写真のIDの配列
     *  @return array               削除した写真のIDの配列。対象とする写真のIDの配列と同等です。失敗した場合は空の配列
     */
    public function removeEventPhotos(int $userId, int $eventId, array $photos): array
    {
        $check = $this->db->getOne('SELECT id FROM events WHERE id = ? AND user_id = ?', [
            $eventId,
            $userId,
        ]);

        if (! $check) {
            return [];
        }

        if (count($photos) === 0) {
            return [];
        }

        $result = $this->db->execute('DELETE FROM photos where event_id = ? AND id IN (?' . str_repeat(', ?', count($photos) - 1) . ')', array_merge(
            [$eventId],
            $photos
        ));

        if (! $result) {
            return [];
        }

        foreach ($photos as $photoId) {
            unlink(self::UPLOAD_PATH . $photoId . '.jpg');
        }

        return $photos;
    }
}
