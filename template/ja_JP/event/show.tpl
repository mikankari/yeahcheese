<div class="ui container">
  <div class="ui basic segment">
    <h2 class="ui center aligned header">{$app.name}{if $app.user}<div class="sub header">プレビュー中</div>{/if}</h2>
  </div>

  <div class="ui basic segment">
    <table class="ui very basic collapsing table">
      <tr>
        <th>公開期限</th>
        <td>{include file="publishat.tpl" publishEndAt=$app.publishEndAt}</td>
      </tr>
      <tr>
        <th>枚数</th>
        <td><div class="largeNumOnly"><b>{$app.photosCount}</b> 枚</div></td>
      </tr>
    </table>
    {if $app.user}
    <a href="?action_event_list=true" class="ui button"><i class="icon arrow left"></i>戻る</a>
    <a href="?action_event_edit=true&event_id={$app.eventId}" class="ui orange button"><i class="icon edit"></i>編集</a>
    <a href="#" class="ui right floated disabled button">
    {else}
    <a href="?action_event_login_revoke=true" class="ui right floated button">
    {/if}
      <i class="icon sign out"></i>他のイベントを見る
    </a>
  </div>

  <div class="ui basic segment">
    <div class="ui grid">
    {foreach from=$app.photos item=item name=photos}
      <div class="four wide column">
        <div class="ui segment">
          <a href="{$app.photosBaseUrl}{$item.id}.jpg" class="highslide">
            <img src="{$app.photosBaseUrl}{$item.id}.jpg" alt="投稿した写真" class="ui fluid image">
          </a>
        </div>
      </div>
    {foreachelse}
      <div class="sixteen wide column">
        <p>写真はまだありません</p>
      </div>
    {/foreach}
    </div>
  </div>
</div>
