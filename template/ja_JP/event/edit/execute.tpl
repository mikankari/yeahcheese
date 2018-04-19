<div class="ui text container">
  <h2 class="ui header">イベント編集</h2>

  <p>イベントの追加が完了しました</p>
  <p>認証キーは今後、確認できません。大切に保管してください。</p>

  <table class="ui very basic table">
    <tr>
      <th class="center aligned">イベント名</th>
      <td>{$app.name}</td>
    </tr>
    <tr>
      <th class="center aligned">公開期間</th>
      <td>{$app.publishStartAt} から {$app.publishEndAt} まで</td>
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

  <div class="ui center aligned container">
    <a href="?action_event_show=true&event_id={$app.eventId}" class="ui black button"><i class="icon arrow right"></i>イベントページへ</a>
  </div>
</div>
