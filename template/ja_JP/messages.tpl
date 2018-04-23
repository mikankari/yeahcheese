  {if count($errors) > 0}
  <div class="ui message error">
    <ul class="ui list">
      {foreach from=$errors item=error name=errors}
      <li>{$error}</li>
      {/foreach}
    </ul>
  </div>
  {/if}
