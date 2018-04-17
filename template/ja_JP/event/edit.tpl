<h2>イベントの編集</h2>

{foreach from=$errors item=error name=errors}
    {if $smarty.foreach.errors.first}
        <ul>
    {/if}
    <li>{$error}</li>
    {if $smarty.foreach.errors.last}
        </ul>
    {/if}
{/foreach}

{form ethna_action="event_edit_execute" enctype="file" name="edit"}
    {form_input name="event_id" default=$app.eventId}
    {form_name name="name"} {form_input name="name" default=$app.name}
    {form_name name="publish_start_at"} {form_input name="publish_start_at" default=$app.publishStartAt}
    {form_name name="publish_end_at"} {form_input name="publish_end_at" default=$app.publishEndAt}
    {form_name name="photos"} {form_input name="photos"}
    {form_submit value="送信"}
{/form}

{form ethna_action="event_edit_delete" name="delete"}
    {form_input name="event_id" default=$app.eventId action="event_edit_delete"}
    {foreach from=$app.photos item=item}
        {form_input name="photos" type="checkbox" value=$item.id}
        <img src="{$app.photosBaseUrl}{$item.id}.jpg" alt="投稿した写真">
    {foreachelse}
        写真はまだありません
    {/foreach}
    選択した{form_name name="photos"}を{form_submit value="削除"}
{/form}

<a href="?action_event_show=true&event_id={$app.eventId}">戻る</a>
<a href="?action_event_list=true">イベント一覧</a>
