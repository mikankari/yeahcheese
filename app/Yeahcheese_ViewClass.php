<?php
// vim: foldmethod=marker
/**
 *  Yeahcheese_ViewClass.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */

class Yeahcheese_ViewClass extends Ethna_ViewClass
{
    /**
     *  > 指定されたフォーム項目に対応するフォームタグを取得する
     *  オーバーライドによって、HTML の required 属性に対応させる
     *
     *  @param  string  name    フォーム項目名
     *  @param  string  action  フォーム項目が定義されているアクション
     *  @param  array   param   テンプレートでの属性値一覧
     *  @return string          フォームタグ
     */
    public function getFormInput($name, $action, $params)
    {
        $af = $this->_getHelperActionForm($action, $name);
        if ($af === null) {
            return '';
        }

        $def = $af->getDef($name);
        if ($def === null) {
            return '';
        }

        if (isset($def['required']) && $def['required'] && ! is_array($def['type'])) {
            $params['required'] = '';
        }

        if (is_array($def['type']) && in_array(VAR_TYPE_FILE, $def['type'])) {
            $params['multiple'] = '';
        }

        return parent::getFormInput($name, $action, $params);
    }
}
