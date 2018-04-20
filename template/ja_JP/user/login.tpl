<div class="ui container text">
  <div class="ui basic segment">
    <h2 class="ui header">ログイン</h2>
  </div>

  <div class="ui basic segment">
    {if count($errors) > 0}
      <div class="ui message error">
        {foreach from=$errors item=error name=errors}
          {if $smarty.foreach.errors.first}
            <ul class="ui list">
          {/if}
          <li>{$error}</li>
          {if $smarty.foreach.errors.last}
            </ul>
          {/if}
        {/foreach}
      </div>
    {/if}

    {form ethna_action="user_login_execute" class="ui form"}
      <div class="field">
        <label for="email">{form_name name="email"}</label>
        {form_input name="email" id="email"}
      </div>
      <div class="field">
        <label for="password">{form_name name="password"}</label>
        {form_input name="password" id="password"}
      </div>
      <button type="submit" class="ui fluid black button"><i class="icon sign in"></i>ログイン</button>
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
