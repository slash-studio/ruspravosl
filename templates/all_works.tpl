{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/all_works.css" rel="stylesheet" />
  <link href="/css/images.css" rel="stylesheet" />
{/block}
{block name='div.main'}
  {include file="header.tpl"}
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
          <a href="#" class="likes">35</a>
        </li>
      {/foreach}
      </ul>
  </div>
{/block}