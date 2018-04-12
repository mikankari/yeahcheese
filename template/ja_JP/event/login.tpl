<h2>イベント閲覧ログイン</h2>

{foreach from=$errors item=error name=errors}
    {if $smarty.foreach.errors.first}
        <ul>
    {/if}
    <li>{$error}</li>
    {if $smarty.foreach.errors.last}
        </ul>
    {/if}
{/foreach}

{form ethna_action="event_login_execute"}
{form_name name="password"}{form_input name="password"}
{form_submit value="ログイン"}
{/form}
