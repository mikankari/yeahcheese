<div class="ui container">
  <h2 class="ui header">イベント一覧</h2>

  {foreach from=$app.events item=item name=events}
    {if $smarty.foreach.events.first}
      <div class="ui relaxed divided list">
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
                <td>{$app_ne.formatedPublishAt[$item.id]}</td>
            </tr>
            <tr>
                <th>枚数</th>
                <td>{$app.photosCount[$item.id]}</td>
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

  <a href="?action_event_edit=true" class="ui black button"><i class="icon plus"></i>追加</a>
</div>
