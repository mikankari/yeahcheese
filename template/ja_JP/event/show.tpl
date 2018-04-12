<h2>{$app.name}</h2>

{$app.publish_start_at} から {$app.publish_end_at} まで

{foreach from=$app.photos item=item}
    <img src="{$app.photos_base_url}{$item.id}.jpg" alt="投稿した写真">
{foreachelse}
    写真はまだありません
{/foreach}

<a href="?action_event_edit=true&event_id={$app.event_id}">編集</a>
<a href="?action_event_login_revoke=true">ログアウト</a>
