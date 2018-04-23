<div class="ui text container">
  <div class="ui very padded basic segment">
    <h2 class="ui center aligned header">YeahCheese! へようこそ<div class="sub header">YeahCheese! は写真を投稿して、招待した人に写真を見せるサービスです。</div></h2>
  </div>

  <ui class="ui very padded basic segment">
    <div class="ui center aligned grid">
      <div class="eight wide column">
        <h3 class="ui header">写真を投稿する</h3>
        {if $app.user}
        <a href="?action_event_list=true" class="ui fluid orange button">イベント一覧</a>
        {else}
        <div class="ui fluid buttons">
          <a href="?action_user_register=true" class="ui orange button">会員登録</a>
          <div class="or"></div>
          <a href="?action_user_login=true" class="ui button">ログイン</a>
        </div>
        {/if}
      </div>
      <div class="eight wide column">
        <h3 class="ui header">招待された写真を見る</h3>
        <a href="?action_event_login=true" class="ui fluid button">閲覧者ログイン</a>
      </div>
    </div>
  </ui>
</div>
