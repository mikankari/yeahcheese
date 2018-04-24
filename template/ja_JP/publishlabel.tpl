{if $publishStartAt|date_format:"%s" gt $smarty.now}
<div class="ui yellow label">公開予定</div>
{elseif $publishStartAt|date_format:"%s" lte $smarty.now and $smarty.now lte $publishEndAt|date_format:"%s"}
<div class="ui orange label">公開中</div>
{else}
<div class="ui label">公開終了</div>
{/if}
