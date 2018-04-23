<div class="ui text container">
  <div class="ui basic segment">
    <h2 class="ui header">イベント閲覧</h2>
  </div>

  <div class="ui basic segment">
    {include file="messages.tpl"}

    {form ethna_action="event_login_execute" class="ui form"}
      <div class="field">
        <label for="password">{form_name name="password"}</label>
        {form_input name="password" id="password"}
      </div>
      <button type="submit" class="ui fluid orange button"><i class="icon sign in"></i>ログイン</button>
    {/form}
  </div>

  <div class="ui basic segment">
    <div class="ui message">
      <p>イベントの管理者ですか？</p>
      <a href="?action_user_login=true">ログイン</a>
    </div>
  </div>
</div>
