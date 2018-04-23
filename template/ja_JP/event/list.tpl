<div class="ui container">
  <div class="ui basic segment">
    <h2 class="ui header">イベント一覧</h2>
  </div>

  <div class="ui basic segment">
    {foreach from=$app.events item=item name=events}
      {if $smarty.foreach.events.first}
        <div class="ui very relaxed divided list">
      {/if}
      <div class="item">
        <div class="right floated content">
          <a href="?action_event_edit=true&event_id={$item.id}" class="ui gray button"><i class="icon edit"></i>編集</a>
        </div>
        <div class="content">
          <a href="?action_event_show=true&event_id={$item.id}" class="header">{$item.name}</a>
          <table class="description ui very basic table">
              <tr>
                  <th>公開期限</th>
                  <td>{$app_ne.formatedPublishAt[$item.id]} {$app_ne.statusLabel[$item.id]}</td>
              </tr>
              <tr>
                  <th>枚数</th>
                  <td><div class="largeNumOnly"><b>{$app.photosCount[$item.id]}</b> 枚</div></td>
              </tr>
          </table>
        </div>
      </div>
      {if $smarty.foreach.events.last}
        </div>
      {/if}
    {foreachelse}
      <p>イベントはまだありません</p>
    {/foreach}
  </div>

  <div class="ui basic segment">
    <a href="?action_event_edit=true" class="ui orange button"><i class="icon plus"></i>追加</a>
  </div>
</div>
