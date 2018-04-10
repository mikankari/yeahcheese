<h2>イベント一覧</h2>

{foreach from=$app.events item=item}
<h3>{$item.name}</h3>
{$item.publish_at} から {$item.publish_end_at} まで
{/foreach}
