{extends file='admin.tpl'}
{block name='title' append} - Просмотр работ{/block}
{block name='links' append}
  <link href="/css/images.css" rel="stylesheet" />
  <link href="/css/admin_photos.css" rel="stylesheet" />
  <script src="/js/admin.photos.js"></script>
  <link href="/colorbox/colorbox.css" rel="stylesheet" />
  <script src="/colorbox/jquery.colorbox.js"></script>
  <script>
	{literal}
	$(document).ready(function(){
		$(".group1").colorbox({});
	});	
	{/literal}
  </script>
{/block}
{block name="div.main"}
  <aside>{$menu}</aside>
    <div id="top_block" class="imgs">
      <h1>{if isset($mainCategoryName)}{$mainCategoryName}{else}Все работы{/if}</h1>
      {if isset($subCategoryName)}<h2>{$subCategoryName}</h2>
        {if 0<=$age && $age<=2}
          <h3>{if $age==0}до 9{elseif $age==1}9 - 12{elseif $age==2}13 - 17{/if} лет</h3>
        {/if}
      {/if}
      <ul>
      {foreach from=$images item=img}
        <li>
          <a href="/includes/uploads/{$img.images_id}_b.jpg" class="group1 block"><img src="/includes/uploads/{$img.images_id}_s.jpg" /></a>
          <div class="name">"{$img.images_name}"</div>
		  <a href="/profile/{$img.images_user_id}" class="user">{$users[$img.images_user_id].users_name} {$users[$img.images_user_id].users_surname} ({$users[$img.images_user_id].users_age} лет)</a>
		  <div class="status_bar">{if $img.images_status == 0}Работа не проверена{elseif $img.images_status == 1}<span class="green">Работа принята!</span>{elseif $img.images_status == 2}<span class="red">Работа отклонена!</span>{elseif $img.images_status == 3}<span class="green">Победитель!</span>{/if}</div>
          <div class="admin">
             <div class="panel">
                <button data-id="{$img.images_id}" data-value="1" class="accept edit_status"></button><button data-id="{$img.images_id}" data-value="2" class="reject edit_status"></button> <button data-id="{$img.images_id}" data-value="3" class="win edit_status"></button><button data-id="{$img.images_id}" class="delete"></button>
             </div>
          </div>
        </li>
      {/foreach}
      </ul>
    </div>
{/block}