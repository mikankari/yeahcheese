<?php
/**
 * Yeahcheese_EventManager.php
 *
 * @author {$author}
 * @package Yeahcheese
 */

class Yeahcheese_EventManager extends Ethna_AppManager
{
    private $lastPassword = '';

    /**
     *  閲覧者がイベントデータにアクセスするために認証する
     *
     *  @param  string  $password   認証キー
     *  @return int     $eventId    認証キーに登録されたイベントのID。認証に失敗した場合は 0
     */
    public function login(string $password): int
    {
        $eventId = $this->db->getOne('SELECT id FROM events WHERE password = ?', [
            $this->hash($password),
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
     *  認証キーのハッシュ化方法。イベントの追加や認証の場合に用いられます。
     *
     *  @param  string  $password   生の認証キー
     *  @return string              認証キーのハッシュ
     */
    public function hash(string $password): string
    {
        return hash('sha256', $password);
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

        $this->lastPassword = $password;

        return $password;
    }

    /**
     *  generatePassword で発行された直近の認証キーを取得する
     *
     *  @return string  認証キー
     **/
    public function getLastPassword(): string
    {
        return $this->lastPassword;
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
     *  @param  int     $userId     共有者ユーザのID。イベントを追加したユーザと一致すれば取得します。閲覧者の場合は 0
     *  @param  int     $eventId    対象とするイベントのID
     *  @return array               イベント。認証していない、または公開期限外の場合は空の配列
     */
    public function getLoginEvent(int $userId, int $eventId): array
    {
        $event = [];

        if ($userId) {
            $event = $this->db->getRow('SELECT * FROM events WHERE id = ? AND user_id = ?', [
                $eventId,
                $userId,
            ]);
        }

        if(! $event){
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
     *  公開期限のタイムスタンプをクライアントのフォームが認識できる書式に変換する
     *
     *  @param  string  $timestamp  DB上のタイムスタンプ
     *  @return                     フォームが認識できる公開期限
     **/
    public static function formatPublishAt(string $timestamp): string
    {
        $parsed = new DateTime($timestamp);

        return $parsed->format('Y-m-d\TH:i');
    }

    /**
     *  公開期限のタイムスタンプを表示のための書式に変換する
     *
     *  @param  int     $userId 表示を求めるユーザ。閲覧者の場合は 0
     *  @param  string  $start  公開期限の開始のタイムスタンプ
     *  @param  string  $end    公開期限の終了のタイムスタンプ
     *  @return string          表示する公開期限
     */
    public static function getPublishAtText(int $userId, string $start, string $end): string
    {
        $format = '<\b>Y</\b> 年 <\b>n</\b> 月 <\b>j</\b> 日 <\b>D H:i</\b>';

        $startParsed = new DateTime($start);
        $endParsed = new DateTime($end);

        $result = '<div class="largeNumOnly">';

        if ($userId) {
            $result .= $startParsed->format($format) . ' 〜 ' . $endParsed->format($format);
        } else {
            $result .= $endParsed->format($format) . ' まで';
        }

        $result .= '</div>';

        return $result;
    }

    /**
     *  公開期限のタイムスタンプから現在の公開状況を取得する
     *
     *  @param  string  $start  公開期限の開始のタイムスタンプ
     *  @param  string  $end    公開期限の終了のタイムスタンプ
     *  @return string          表示する公開状況
     */
    public static function getStatusLabel(string $start, string $end): string
    {
        $startParsed = new DateTime($start);
        $endParsed = new DateTime($end);
        $current = new DateTime();

        $status = '公開終了';
        $color = '';
        if ($startParsed > $current) {
            $status = '公開予定';
            $color = ' yellow';
        } else if ($startParsed <= $current && $current <= $endParsed) {
            $status = '公開中';
            $color = ' orange';
        }

        return '<div class="ui' . $color . ' label">' . $status . '</div>';
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
            $this->hash($password),
            $formVars['publish_start_at'],
            $formVars['publish_end_at'],
        ]);

        if (! $result) {
            return 0;
        }

        $this->login($password);

        return $this->db->getOne('SELECT lastval()');
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
