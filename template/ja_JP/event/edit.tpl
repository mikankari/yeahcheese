<div class="ui container">
  <h2>イベントの編集</h2>

  {if count($errors) > 0}
    <div class="ui message error">
    {foreach from=$errors item=error name=errors}
      {if $smarty.foreach.errors.first}
        <ul class="ui list">
      {/if}
      <li>{$error}</li>
      {if $smarty.foreach.errors.last}
        </ul>
      {/if}
    {/foreach}
    </div>
  {/if}

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
    <a href="?action_event_{if $app.eventId}show=true&event_id={$app.eventId}{else}list=true{/if}" class="ui button"><i class="icon arrow left"></i>戻る</a>
    <button type="submit" class="ui black button"><i class="icon save"></i>送信</button>
  {/form}

  <div class="ui hidden divider"></div>

  {form ethna_action="event_edit_delete" name="delete" class="ui form"}
    {form_input name="event_id" default=$app.eventId action="event_edit_delete"}
    <div class="field">
      <label for="">{form_name name="photos"}の削除</label>
    </div>
    {foreach from=$app.photos item=item name="photos"}
      {if $smarty.foreach.photos.first}
        <div class="ui grid">
      {/if}
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
      {if $smarty.foreach.photos.last}
        </div>
      {/if}
    {foreachelse}
      <p>写真はまだありません</p>
    {/foreach}
    <button type="submit" class="ui black button"><i class="icon trash"></i>削除</button>
  {/form}
</div>
