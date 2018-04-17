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

    <label for="name">{form_name name="name"}</label>
    <div class="field">
      {form_input name="name" class="form-control"}
    </div>
  <!--  {message name="name"}-->
    <label for="email">{form_name name="email" id="email"}</label>
    <div class="field">
    {form_input name="email" class="form-control"}
    </div>
  <!--  {message name="email"}-->
    <label for="password">{form_name name="password"}</label>
    <div class="field">
    {form_input name="password" class="form-control"}
    </div>
  <!--  {message name="password"}-->
    <label for="password_confirm">{form_name name="password_confirm"}</label>
    <div class="field">
    {form_input name="password_confirm" class="form-control"}
    </div>
  <!--  {message name="password_confirm"}-->

    {form_submit value="登録" class="ui fluid black submit button"}
  {/form}

  <div class="ui message">
    <div class="center aligned">
      <p>アカウントをお持ちですか？</p>
      <a href="?action_user_login=true">ログイン</a>
    </div>
  </div>

</div>
