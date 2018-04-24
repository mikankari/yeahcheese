<div class="ui text container">
  <div class="ui basic segment">
    <h2 class="ui header">イベント編集</h2>
  </div>

  <div class="ui basic segment">
    <p>イベントの追加が完了しました</p>
    <p>認証キーは今後、確認できません。大切に保管してください。</p>

    <table class="ui very basic table">
      <tr>
        <th class="center aligned">イベント名</th>
        <td>{$app.name}</td>
      </tr>
      <tr>
        <th class="center aligned">公開期間</th>
        <td>{$app_ne.publishAtText}</td>
      </tr>
      <tr>
        <th class="center aligned">認証キー</th>
        <td>
          <div class="ui action input">
            <input type="text" readonly="readonly" value="{$app.password}">
            <button class="ui right icon button"><i class="icon copy"></i></button>
          </div>
        </td>
      </tr>
    </table>
  </div>

  <div class="ui center aligned basic segment">
    <a href="?action_event_show=true&event_id={$app.eventId}" class="ui orange button"><i class="icon arrow right"></i> イベントページへ</a>
  </div>
</div>
