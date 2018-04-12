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
     *  @return                     共有者のID
     */
    public function login($email, $password): int
    {
        $userId = $this->db->getOne('SELECT id FROM users WHERE email = ? AND password = ?', [
            $email,
            hash('sha256', $password),
        ]);

        if (! $userId) {
            return false;
        }

        $this->session->start();
        $this->session->set('user_id', $userId);

        return $userId;
    }
}
