{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/all_works.css" rel="stylesheet" />
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
          <a href="/includes/uploads/{$img.images_id}_b.jpg" class="group1 block"><img src="/includes/uploads/{$img.images_id}_s.jpg" /></a>
		  <div class="name">"{$img.images_name}"</div>
          <a href="/profile/{$img.images_user_id}" class="user">{$users[$img.images_user_id].users_name} {$users[$img.images_user_id].users_surname} ({$users[$img.images_user_id].users_age} лет)</a> 
        </li>
      {/foreach}
      </ul>
  </div>
{/block}