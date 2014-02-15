{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/archive.css" rel="stylesheet" />
  <link href="/css/images.css" rel="stylesheet" />
  <link href="/colorbox/colorbox.css" rel="stylesheet" />
  <script src="/colorbox/jquery.colorbox.js"></script>
  <script>
  {literal}
    $(document).ready(function(){
      $(".group1").colorbox({rel:'group1'});
    });
  {/literal}
  </script>
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <aside>{$cats}</aside>
  <div id="top_block" class="imgs">
    {if $isWinnersPages}
      <h1>{$contestName}: Победители</h1>
      {foreach from=$winners_cat item=rootCat}
        <h2>{$rootCat.info.categories_name}</h3>
        {foreach from=$rootCat.subcat item=cat}
          <h3>«{$cat.categories_name}»</h3>
          {assign var="hasWinners" value=false}
          {foreach from=$cat.imgs_info item=imgs key=age}
          {if $imgs|@count > 0}
            {assign var="hasWinners" value=true}
            <h4>{$ages[$age]} лет</h4>
              <ul>
              {foreach from=$imgs item=img}
                <li>
                  <a href="/includes/uploads/{$img.images_id}_b.jpg" class="group1 block">
                    <img src="/includes/uploads/{$img.images_id}_b.jpg" />
                  </a>
                  <div class="name">"{$img.images_name}"</div>
                    <a href="/profile/{$img.images_user_id}" class="user">{$img.users_name} {$img.users_surname} ({$img.users_age} лет)</a>
                </li>
              {/foreach}
              </ul>
          {/if}
          {/foreach}
          {if !$hasWinners}<h4>Победителей нет</h4>{/if}
        {/foreach}
      {/foreach}
    {else}
     <h1>{if isset($mainCategoryName)}{$mainCategoryName}{elseif isset($contID)}{$contestName}{else}Архив{/if}</h1>
      {if isset($subCategoryName)}<h3>{$subCategoryName}</h3>
        {if 0<=$age && $age<=2}
          <h4>{if $age==0}до 8{elseif $age==1}8 - 12{elseif $age==2}13 - 17{/if} лет</h4>
        {/if}
      {/if}
      <ul>
      {foreach from=$images item=img}
        <li>
          <a href="/includes/uploads/{$img.images_id}_b.jpg" class="group1 block"><img src="/includes/uploads/{$img.images_id}_s.jpg" /></a>
        <div class="name">"{$img.images_name}"</div>
          <a href="/profile/{$img.images_user_id}" class="user">{$users[$img.images_user_id].users_name} {$users[$img.images_user_id].users_surname} ({$users[$img.images_user_id].users_age} лет)</a>
        </li>
      {/foreach}
      </ul>
    {/if}
  </div>
{/block}