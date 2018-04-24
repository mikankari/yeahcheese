<div class="ui container">
  <div class="ui basic segment">
    <h2 class="ui header">イベント一覧</h2>
  </div>

  <div class="ui basic segment">
    <div class="ui very relaxed divided list">
    {foreach from=$app.events item=item name=events}
      <div class="item">
        <div class="right floated content">
          <a href="?action_event_edit=true&event_id={$item.id}" class="ui gray button"><i class="icon edit"></i>編集</a>
        </div>
        <div class="content">
          <a href="?action_event_show=true&event_id={$item.id}" class="header">{$item.name}</a>
          <table class="description ui very basic table">
              <tr>
                  <th>公開期限</th>
                  <td>{include file="publishat.tpl" publishStartAt=$item.publish_start_at publishEndAt=$item.publish_end_at} {include file="publishlabel.tpl" publishStartAt=$item.publish_start_at publishEndAt=$item.publish_end_at}</td>
              </tr>
              <tr>
                  <th>枚数</th>
                  <td><div class="largeNumOnly"><b>{$app.photosCount[$item.id]}</b> 枚</div></td>
              </tr>
          </table>
        </div>
      </div>
    {foreachelse}
      <div class="item">
        <p>イベントはまだありません</p>
      </div>
    {/foreach}
    </div>
  </div>

  <div class="ui basic segment">
    <a href="?action_event_edit=true" class="ui orange button"><i class="icon plus"></i>追加</a>
  </div>
</div>
