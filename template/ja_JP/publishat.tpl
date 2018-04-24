{if $publishStartAt}
<div class="largeNumOnly">{$publishStartAt|date_format:"<b>%Y</b> / <b>%m</b> / <b>%d</b> (<b>%a</b>) <b>%H</b>:<b>%M</b>"}</div>
 〜
{/if}
<div class="largeNumOnly">{$publishEndAt|date_format:"<b>%Y</b> / <b>%m</b> / <b>%d</b> (<b>%a</b>) <b>%H</b>:<b>%M</b>"}</div>
{if not $publishStartAt}
まで
{/if}
