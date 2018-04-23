<div class="ui container">
  <h2>イベントの編集</h2>

  {include file="messages.tpl"}

  {form ethna_action="event_edit_execute" enctype="file" name="edit" class="ui form"}
    {form_input name="event_id" default=$app.eventId}
    <div class="field">
      <label for="name">{form_name name="name"}</label>
      {form_input name="name" default=$app.name id="name"}
    </div>
    <div class="field">
      <label for="publish_start_at">{form_name name="publish_start_at"}</label>
      {form_input name="publish_start_at" default=$app.publishStartAt id="publish_start_at"}
    </div>
    <div class="field">
      <label for="publish_end_at">{form_name name="publish_end_at"}</label>
      {form_input name="publish_end_at" default=$app.publishEndAt id="publish_end_at"}
    </div>
    <div class="field">
      <label for="photos">{form_name name="photos"}の追加</label>
      {form_input name="photos" id="photos"}
    </div>
    <a href="?action_event_{if $app.eventId}show=true&event_id={$app.eventId}{else}list=true{/if}" class="ui button">戻る</a>
    {form_submit value="送信" class="ui black button"}
  {/form}

  <div class="ui hidden divider"></div>

  {form ethna_action="event_edit_delete" name="delete" class="ui form"}
    {form_input name="event_id" default=$app.eventId action="event_edit_delete"}
    <div class="field">
      <label for="">{form_name name="photos"}の削除</label>
      <div class="ui grid">
        {foreach from=$app.photos item=item name="photos"}
        <div class="four wide column">
          <div class="ui checkbox">
            {form_input name="photos" type="checkbox" value=$item.id id="photos-`$item.id`"}
            <label for="photos-{$item.id}">
              <img src="{$app.photosBaseUrl}{$item.id}.jpg" alt="投稿した写真" class="ui fluid image">
            </label>
          </div>
        </div>
        {foreachelse}
        <div class="sixteen wide column">
          <p>写真はまだありません</p>
        </div>
        {/foreach}
      </div>
    </div>
    {form_submit value="削除" class="ui black button"}
  {/form}
</div>
