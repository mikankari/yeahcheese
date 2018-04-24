<div class="ui container text">
  <div class="ui basic segment">
    <h2 class="ui header">ログイン</h2>
  </div>

  <div class="ui basic segment">
    {include file="messages.tpl"}

    {form ethna_action="user_login_execute" class="ui form"}
      <div class="field">
        <label for="email">{form_name name="email"}</label>
        {form_input type="email" name="email" id="email"}
      </div>
      <div class="field">
        <label for="password">{form_name name="password"}</label>
        {form_input name="password" id="password"}
      </div>
      <button type="submit" class="ui fluid orange button"><i class="icon sign in"></i>ログイン</button>
    {/form}
  </div>

  <div class="ui basic segment">
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
</div>
