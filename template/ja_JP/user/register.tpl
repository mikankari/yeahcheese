<div class="ui container text">
  <div class="ui basic segment">
    <h2 class="ui header">会員登録</h2>
  </div>

  <div class="ui basic segment">
    {include file="messages.tpl"}

    {form ethna_action="user_register_execute" class="ui form"}
      <div class="field">
        <label for="name">{form_name name="name"}</label>
        {form_input name="name" id="name" class="form-control"}
      </div>
      <div class="field">
        <label for="email">{form_name name="email"}</label>
        {form_input type="email" name="email" id="email" class="form-control"}
      </div>
      <div class="field">
        <label for="password">{form_name name="password"}</label>
        {form_input name="password" id="password" class="form-control"}
      </div>
      <div class="field">
        <label for="password_confirm">{form_name name="password_confirm"}</label>
        {form_input name="password_confirm" id="password_confirm" class="form-control"}
      </div>
      <button type="submit" class="ui fluid orange button"><i class="icon sign in"></i>登録</button>
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
          <p>アカウントをお持ちですか？</p>
          <a href="?action_user_login=true">ログイン</a>
        </div>
      </div>
    </div>
  </div>
</div>
