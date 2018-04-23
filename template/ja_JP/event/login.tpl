<div class="ui text container">
  <div class="ui basic segment">
    <h2 class="ui header">イベント閲覧</h2>
  </div>

  <div class="ui basic segment">
    {if count($errors) > 0}
      <div class="ui message error">
        {foreach from=$errors item=error name=errors}
          {if $smarty.foreach.errors.first}
            <ul>
          {/if}
          <li>{$error}</li>
          {if $smarty.foreach.errors.last}
            </ul>
          {/if}
        {/foreach}
      </div>
    {/if}

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
