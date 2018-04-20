<div class="ui container text">
  <h2 class="ui header">ログイン</h2>

  {include file="messages.tpl"}

  {form ethna_action="user_login_execute" class="ui form"}
    <div class="field">
      <label for="email">{form_name name="email"}</label>
      {form_input name="email" id="email"}
    </div>
    <div class="field">
      <label for="password">{form_name name="password"}</label>
      {form_input name="password" id="password"}
    </div>
    {form_submit value="ログイン" class="ui fluid black button"}
  {/form}

  <div class="ui message">
    <div class="ui grid">
      <div class="eight wide column">
        <p>認証キーをお持ちですか？</p>
        <a href="?action_event_login=true">イベントを見る</a>
      </div>
      <div class="eight wide column">
        <p>はじめてのログインですか？</p>
        <a href="?action_user_register=true">会員登録</a>
      </div>
    </div>
  </div>
</div>
