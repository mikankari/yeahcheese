<div class="ui container text">
  <h2 class="ui header">会員登録</h2>

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
    <button type="submit" class="ui fluid black button"><i class="icon sign in"></i>登録</button>
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
