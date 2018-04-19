<h2>ログイン</h2>

{foreach from=$errors item=error name=errors}
    {if $smarty.foreach.errors.first}
        <ul>
    {/if}
    <li>{$error}</li>
    {if $smarty.foreach.errors.last}
        </ul>
    {/if}
{/foreach}

{form ethna_action="user_login_execute"}
{form_name name="email"}{form_input name="email"}
{form_name name="password"}{form_input name="password"}
{form_submit value="ログイン"}
{/form}

<a href="?action_user_register=true">会員登録</a>
<a href="?action_event_login=true">閲覧者</a>
