<div class="ui text container">
  <h2>イベント閲覧</h2>

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
      {form_input name="password"}
    </div>
    <button type="submit" class="ui fluid black button"><i class="icon sign in"></i>ログイン</button>
  {/form}

  <div class="ui message">
    <p>イベントの管理者ですか？</p>
    <a href="?action_user_login=true">ログイン</a>
  </div>
</div>
