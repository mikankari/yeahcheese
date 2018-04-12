<h2>イベント一覧</h2>

{foreach from=$app.events item=item name=events}
    <h3>{$item.name}</h3>
    {$item.publish_start_at} から {$item.publish_end_at} まで
    <a href="?action_event_show=true&event_id={$item.id}">詳しく</a>
{foreachelse}
    イベントはまだありません
{/foreach}
