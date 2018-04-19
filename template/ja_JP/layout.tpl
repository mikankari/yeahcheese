<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./semantic/semantic.min.css">
  <link rel="stylesheet" href="./css/main.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script scr="./semantic/semantic.min.js"></script>
  <title>Yeahcheese!</title>
</head>

<body>
  <div class="ui inverted menu">
    <div class="ui container">
      <div class="header item">
        <h1 style="font-family: BrushScriptMT;">Yeahcheese!</h1>
      </div>
      {if $app.user}
      <a href="?action_event_list=true" class="item"><i class="icon list"></i>イベント一覧</a>
      <a href="?action_event_edit=true" class="item"><i class="icon plus"></i>イベント追加</a>
      <div class="right menu">
        <a href="?action_user_index=true" class="item">{$app.user.email} さん</a>
        <a href="?action_user_login_revoke=true" class="item"><i class="icon sign out"></i>ログアウト</a>
      </div>
      {/if}
    </div>
  </div>
  <div class="ui main">
    {$content}
  </div>
  <div class="ui footer segment">
    <div class="ui center aligned container">
      <p class="">Powered By Ethnam - {$smarty.const.ETHNA_VERSION}.</p>
    </div>
  </div>
</body>

</html>
