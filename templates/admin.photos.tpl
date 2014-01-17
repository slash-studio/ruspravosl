{extends file='admin.tpl'}
{block name='links' append}
  <link href="/css/images.css" rel="stylesheet" />
  <link href="/css/admin_photos.css" rel="stylesheet" />
{/block}
{block name="div.main"}
  <aside>{$menu}</aside>
    <div id="top_block" class="imgs">
      <h1>{if isset($mainCategoryName)}{$mainCategoryName}{else}Все работы{/if}</h1>
      {if isset($subCategoryName)}<h2>{$subCategoryName}</h2>
        {if 0<=$age && $age<=2}
          <h3>{if $age==0}8 - 12{elseif $age==1}13 - 18{elseif $age==2}19 - 30{/if} лет</h3>
        {/if}
      {/if}
      <ul>
      {foreach from=$images item=img}
        <li>
          <a href="#" class="block"><img src="/includes/uploads/{$img.images_id}_s.jpg" /></a>
          <a href="#" class="user">{$users[$img.images_user_id].users_name} {$users[$img.images_user_id].users_surname} ({$users[$img.images_user_id].users_age})</a>
          <div class="admin">
             <span class="likes">35</span>
             <div class="panel">
                <button class="accept">V</button><button class="reject">Л</button><button class="delete">X</button>
             </div>
          </div>
        </li>
      {/foreach}
      </ul>
    </div>
{/block}