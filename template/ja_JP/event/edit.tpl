<h2>イベントの編集</h2>

{if count($errors)}
 <ul>
  {foreach from=$errors item=error}
   <li>{$error}</li>
  {/foreach}
 </ul>
{/if}
{form ethna_action="event_edit" enctype="file" name="event_edit"}
{form_input name="event_id" default=$app.event_id}
{form_name name="name"} {form_input name="name" default=$app.name}
{form_name name="publish_at"} {form_input name="publish_at" default=$app.publish_at}
{form_name name="publish_end_at"} {form_input name="publish_end_at" default=$app.publish_end_at}
{form_name name="photos"} {form_input name="photos"}
{form_submit value="送信"}
{/form}
