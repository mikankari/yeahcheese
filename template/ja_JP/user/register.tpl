<h2>会員登録</h2>

{foreach from=$errors item=error name=errors}
    {if $smarty.foreach.errors.first}
        <ul>
    {/if}
    <li>{$error}</li>
    {if $smarty.foreach.errors.last}
        </ul>
    {/if}
{/foreach}

{form ethna_action="user_register_execute"}
{form_name name="name"}{form_input name="name"}
{form_name name="email"}{form_input name="email"}
{form_name name="password"}{form_input name="password"}
{form_name name="password_confirm"}{form_input name="password_confirm"}
{form_submit value="登録"}
{/form}
