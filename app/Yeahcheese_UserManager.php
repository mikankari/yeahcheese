<?php
/**
 * Yeahcheese_UserManager.php
 *
 * @author {$author}
 * @package Yeahcheese
 */

class Yeahcheese_UserManager extends Ethna_AppManager
{
    /**
     *  共有者がイベント管理のために認証する
     *
     *  @param  string  $email      共有者のメールアドレス
     *  @param  string  $password   共有者のパスワード
     *  @return int                 共有者のID。失敗した場合は 0
     */
    public function login(string $email, string $password): int
    {
        $userId = $this->db->getOne('SELECT id FROM users WHERE email = ? AND password = ?', [
            $email,
            $this->hash($password),
        ]);

        if (! $userId) {
            return 0;
        }

        $this->session->start();
        $this->session->set('user_id', $userId);

        return $userId;
    }

    /**
     *  認証を取り消す
     */
    public function logout(): void
    {
        $this->session->set('user_id', false);
    }

    /**
     *  認証のための共有者を登録する
     *
     *  @param  array   $formVars   name, email, password をキーとして持つ連想配列
     *  @return int                 登録した共有者のID。失敗した場合は 0
     */
    public function register(array $formVars): int
    {
        $result = $this->db->execute('INSERT INTO users (name, email, password) VALUES (?, ?, ?)', [
            $formVars['name'],
            $formVars['email'],
            $this->hash($formVars['password']),
        ]);

        if (! $result) {
            return 0;
        }

        return $this->login($formVars['email'], $formVars['password']);
    }

    /**
     *  パスワードのハッシュ化方法。登録や認証の場合に用いられます。
     *
     *  @param  string  $password   生のパスワード
     *  @return string              パスワードのハッシュ
     */
    private function hash(string $password): string
    {
        return hash('sha256', $password);
    }

    /**
     *  認証済みのユーザを取得する
     *
     *  @return array   ユーザ。ログインしていない場合は空の配列
     */
    public function getUser(): array
    {
        $userId = $this->session->get('user_id');

        if (! $userId) {
            return [];
        }

        return $this->db->getRow('SELECT * FROM users WHERE id = ?', [
            $userId,
        ]);
    }
}
