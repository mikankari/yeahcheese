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
     *  @return int     $eventId    認証キーに登録されたイベントのID。認証に失敗した場合は 0
     */
    public function login(string $password): int
    {
        $eventId = $this->db->getOne('SELECT id FROM events WHERE password = ?', [
            $password, // 実装予定： hash('sha256', $password),
        ]);

        if (! $eventId) {
            return 0;
        }

        $this->session->start();
        $this->session->set('event_id', $eventId);

        return $eventId;
    }

    /**
     *  認証を取り消す
     */
    public function logout(): void
    {
        $this->session->set('event_id', 0);
    }

    /**
     *  既存のイベントと重複しない認証キーを発行する
     *
     *  @return string  認証キー
     */
    private function generatePassword(): string
    {
        $password = '';

        do {
            $password = uniqid();

            $isDuplicated = $this->db->getOne('SELECT id FROM events WHERE password = ?', [
                $password,
            ]);
        } while ($isDuplicated);

        return $password;
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
     *  閲覧者が認証済みのイベント、またはユーザが追加したあるイベントを取得する
     *
     *  @param  int     $userId     共有者ユーザのID。閲覧者の場合は FALSE
     *  @param  int     $eventId    対象とするイベントのID
     *  @return array   イベント。認証していない、または公開期限外の場合は空の配列
     */
    public function getLoginEvent(int $userId, int $eventId): array
    {
        $event = [];

        if ($userId) {
            $event = $this->db->getRow('SELECT * FROM events WHERE id = ? AND user_id = ?', [
                $eventId,
                $userId,
            ]);
        } else {
            if ($eventId != $this->session->get('event_id')) {
                return [];
            }

            $event = $this->db->getRow('SELECT * FROM events WHERE id = ? AND CURRENT_TIMESTAMP BETWEEN publish_start_at AND publish_end_at', [
                $eventId,
            ]);
        }

        return $event;
    }

    /**
     *  あるユーザによるイベントを追加する
     *
     *  @param  int     $userId     追加するユーザのID
     *  @param  array   $formVars   name, publish_start_at, publish_end_at をキーとして持つ連想配列
     *  @return int                 追加したイベントのID。失敗した場合は 0
     */
    public function addUserEvent(int $userId, array $formVars): int
    {
        $password = $this->generatePassword();

        $result = $this->db->execute('INSERT INTO events (user_id, name, password, publish_start_at, publish_end_at) VALUES (?, ?, ?, ?, ?)', [
            $userId,
            $formVars['name'],
            $password,
            $formVars['publish_start_at'],
            $formVars['publish_end_at'],
        ]);

        if (! $result) {
            return 0;
        }

        $this->login($password);

        return $this->db->getOne('SELECT MAX(id) FROM events');
    }

    /**
     *  あるイベントを編集する
     *
     *  @param  int     $userId     イベントを追加したユーザのID。イベントを追加したユーザと一致すれば編集します。
     *  @param  int     $eventId    対象とするイベントのID
     *  @param  array   $formVars   name, publish_start_at, publish_end_at をキーとして持つ連想配列
     *  @return int                 編集したイベントのID。対象とするイベントIDと同等です。失敗した場合は 0
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
            return 0;
        }

        return $eventId;
    }
}
