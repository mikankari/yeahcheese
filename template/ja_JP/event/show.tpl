<div class="ui container">
  <h2 class="ui header">{$app.name}</h2>

  <p>{$app.publishStartAt} から {$app.publishEndAt} まで</p>
  {if $app.user}
    <a href="?action_event_list=true" class="ui button">戻る</a>
    <a href="?action_event_edit=true&event_id={$app.eventId}" class="ui black button">編集</a>
  {else}
    <div class="ui right aligned container">
      <a href="?action_event_login_revoke=true" class="ui button">他のイベントを見る</a>
    </div>
  {/if}

  <div class="ui hidden divider"></div>

  {foreach from=$app.photos item=item name=photos}
    {if $smarty.foreach.photos.first}
      <div class="ui grid">
    {/if}
    <div class="four wide column">
      <img src="{$app.photosBaseUrl}{$item.id}.jpg" alt="投稿した写真" class="ui fluid image">
    </div>
    {if $smarty.foreach.photos.last}
      </div>
    {/if}
  {foreachelse}
    <p>写真はまだありません</p>
  {/foreach}
</div>
