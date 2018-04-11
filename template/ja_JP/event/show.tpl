<h2>{$app.name}</h2>
{$app.publish_at} から {$app.publish_end_at} まで

{foreach from=$app.photos item=item}
<img src="./upload/photos/{$item.id}.jpg" alt="投稿した写真">
{/foreach}

<a href="?action_event_edit=true&event_id={$app.event_id}">編集</a>
