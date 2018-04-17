<h2>{$app.name}</h2>

{$app.publishStartAt} から {$app.publishEndAt} まで

{foreach from=$app.photos item=item}
    <img src="{$app.photosBaseUrl}{$item.id}.jpg" alt="投稿した写真">
{foreachelse}
    写真はまだありません
{/foreach}

<a href="?action_event_edit=true&event_id={$app.eventId}">編集</a>
<a href="?action_event_login_revoke=true">ログアウト</a>
