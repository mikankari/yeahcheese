<div class="ui container">
  <div class="ui basic segment">
    <h2 class="ui header">イベントの{if $app.eventId}編集{else}追加{/if}</h2>
  </div>

  <div class="ui basic segment">
    {include file="messages.tpl"}

    {form ethna_action="event_edit_execute" enctype="file" name="edit" class="ui form"}
      {form_input name="event_id" default=$app.eventId}
      <div class="field">
        <label for="name">{form_name name="name"}</label>
        {form_input name="name" default=$app.name id="name"}
      </div>
      <div class="field">
        <label for="publish_start_at">{form_name name="publish_start_at"}</label>
        {form_input type="datetime-local" name="publish_start_at" default=$app.publishStartAt id="publish_start_at"}
      </div>
      <div class="field">
        <label for="publish_end_at">{form_name name="publish_end_at"}</label>
        {form_input type="datetime-local" name="publish_end_at" default=$app.publishEndAt id="publish_end_at"}
      </div>
      <div class="field">
        <label for="photos">{form_name name="photos"}の追加</label>
         {form_input name="photos" id="photos"}
      </div>
      <a href="?action_event_{if $app.eventId}show=true&event_id={$app.eventId}{else}list=true{/if}" class="ui button"><i class="icon arrow left"></i>戻る</a>
      <button type="submit" class="ui orange button"><i class="icon save"></i>送信</button>
    {/form}
  </div>

  {if $app.eventId}
  <div class="ui basic segment">
    {form ethna_action="event_edit_delete" name="delete" class="ui form"}
      {form_input name="event_id" default=$app.eventId action="event_edit_delete"}
      <div class="field">
        <label for="">{form_name name="photos"}の削除</label>
      </div>
      <div class="ui grid">
      {foreach from=$app.photos item=item name="photos"}
        <div class="four wide column">
          <div class="ui checkbox">
            {form_input name="photos" type="checkbox" value=$item.id id="photos-`$item.id`"}
            <label for="photos-{$item.id}">
              <div class="ui segment">
                <img src="{$app.photosBaseUrl}{$item.id}.jpg" alt="投稿した写真" class="ui fluid image">
              </div>
            </label>
          </div>
        </div>
      {foreachelse}
        <div class="sixteen wide column">
          <p>写真はまだありません</p>
        </div>
      {/foreach}
      </div>
      <button type="submit" class="ui orange button"><i class="icon trash"></i>削除</button>
    {/form}
  </div>
  {/if}
</div>
