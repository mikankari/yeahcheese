<?php
/**
 * Yeahcheese_EventManager.php
 *
 * @author {$author}
 * @package Yeahcheese
 */

class Yeahcheese_EventManager extends Ethna_AppManager
{
    /**
     *  閲覧者がイベントデータにアクセスするために認証する
     *
     *  @param  string  $password   認証キー
     *  @return int     $eventId    認証キーに登録されたイベントのID
     */
    public function login(string $password): int
    {
        $eventId = $this->db->getOne('SELECT id FROM events WHERE password = ?', [
            $password, // 実装予定： hash('sha256', $password),
        ]);

        if (! $eventId) {
            return false;
        }

        $this->session->start();
        $this->session->set('event_id', $eventId);

        return $eventId;
    }

    /**
     *  あるユーザが投稿したすべてのイベントを取得する
     *
     *  @param  int     $userId 対象とするユーザのID
     *  @return array           イベントの配列
     */
    public function getUserEvents(int $userId): array
    {
        return $this->db->getAll('SELECT * FROM events WHERE user_id = ?', [
            $userId,
        ]);
    }

    /**
     *  あるイベント１件を取得する
     *
     *  @param  int     $eventId    対象とするイベントのID
     *  @return array               イベント
     */
    public function getEvent(int $eventId): array
    {
        return $this->db->getRow('SELECT * FROM events WHERE id = ?', [
            $eventId,
        ]);
    }

    /**
     *  あるユーザによるイベントを追加する
     *
     *  @param  int     $userId     追加するユーザのID
     *  @param  array   $formVars   name, publish_start_at, publish_end_at をキーとして持つ連想配列
     *  @return int                 追加したイベントのID。失敗した場合はFALSE。
     */
    public function addUserEvent(int $userId, array $formVars): int
    {
        $result = $this->db->execute('INSERT INTO events (user_id, name, password, publish_start_at, publish_end_at) VALUES (?, ?, ?, ?, ?)', [
            $userId,
            $formVars['name'],
            uniqid(),   // 未実装のため仮データ
            $formVars['publish_start_at'],
            $formVars['publish_end_at'],
        ]);

        if (! $result) {
            return false;
        }

        $insertId = $this->db->getOne('SELECT MAX(id) FROM events');

        return $insertId;
    }

    /**
     *  あるイベントを編集する
     *
     *  @param  int     $userId     イベントを追加したユーザのID。イベントを追加したユーザと一致すれば編集します。
     *  @param  int     $eventId    対象とするイベントのID
     *  @param  array   $formVars   name, publish_start_at, publish_end_at をキーとして持つ連想配列
     *  @return int                 編集したイベントのID。対象とするイベントIDと同等です。失敗した場合はFALSE。
     */
    public function editUserEvent(int $userId, int $eventId, array $formVars): int
    {
        $result = $this->db->execute('UPDATE events SET name = ?, publish_start_at = ?, publish_end_at = ? WHERE id = ? AND user_id = ?', [
            $formVars['name'],
            $formVars['publish_start_at'],
            $formVars['publish_end_at'],
            $eventId,
            $userId,
        ]);

        if (! $result) {
            return false;
        }

        return $eventId;
    }
}
