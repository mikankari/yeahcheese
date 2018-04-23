<div class="ui text container">
  <h2>イベント閲覧</h2>

  {include file="messages.tpl"}

  {form ethna_action="event_login_execute" class="ui form"}
    <div class="field">
      <label for="password">{form_name name="password"}</label>
      {form_input name="password"}
    </div>
    {form_submit value="ログイン" class="ui fluid black button"}
  {/form}

  <div class="ui message">
    <p>イベントの管理者ですか？</p>
    <a href="?action_user_login=true">ログイン</a>
  </div>
</div>
