<div class="ui container text">
  <h2 class="ui header">会員登録</h2>

  {include file="messages.tpl"}

  {form ethna_action="user_register_execute" class="ui form"}
    <div class="field">
      <label for="name">{form_name name="name"}</label>
      {form_input name="name" id="name" class="form-control"}
    </div>
    <div class="field">
      <label for="email">{form_name name="email"}</label>
      {form_input name="email" id="email" class="form-control"}
    </div>
    <div class="field">
      <label for="password">{form_name name="password"}</label>
      {form_input name="password" id="password" class="form-control"}
    </div>
    <div class="field">
      <label for="password_confirm">{form_name name="password_confirm"}</label>
      {form_input name="password_confirm" id="password_confirm" class="form-control"}
    </div>
    {form_submit value="登録" class="ui fluid black submit button"}
  {/form}

  <div class="ui message">
    <div class="ui grid">
      <div class="eight wide column">
        <p>認証キーをお持ちですか？</p>
        <a href="?action_event_login=true">イベントを見る</a>
      </div>
      <div class="eight wide column">
        <p>アカウントをお持ちですか？</p>
        <a href="?action_user_login=true">ログイン</a>
      </div>
    </div>
  </div>
</div>
