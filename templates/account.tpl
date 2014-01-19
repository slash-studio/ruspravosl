{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/account.css" rel="stylesheet" />
  <link href="/css/images.css" rel="stylesheet" />
  {if $acc_self == 1}<script src="/js/ajaxupload.3.5.js"></script>{/if}
  {if $acc_self == 1}<script src="/js/upload_photo.js"></script>{/if}
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <div id="top_block">
    <h1>{if $acc_self == 1}Мой аккаунт{else}{$fullname}{/if}</h1>
    {if $acc_self == 1}<span class="info">Логин: <b>{$login}</b></span>{/if}
    {if $acc_self == 1}<span class="info">Имя: <b>{$fullname}</b></span>{/if}
    <span class="info">Возраст: <b>{$age}</b></span>
    {if $acc_self == 1}<span class="info">Адрес: <b>{$address}</b></span>{/if}
    {if $acc_self == 1}<span class="info">Школа: <b>{$school}</b></span>{/if}
    <div class="imgs">
      <h2>Загруженные фотографии</h2>
      {foreach from=$cats item=rootCat}
        <h3>{$rootCat.info.categories_name}</h3>
        {foreach from=$rootCat.subcat item=cat}
          <div>
            <h4>«{$cat.categories_name}»</h4>
            {if $acc_self == 1}<button class="upload" data="{$id},{$cat.categories_id}">Загрузить фото</button>{/if}
            <ul>
            {foreach from=$cat.imgs_info item=img}
            <li>
            <a href="#" class="block {if $img.images_status == 0}not_checked{elseif $img.images_status == 1}accepted{elseif $img.images_status == 2}rejected{/if}"
						title="{if $img.images_status == 0}Ваша работа не проверена{elseif $img.images_status == 1}Ваша работа принята!{elseif $img.images_status == 2}Ваша работа отклонена!{/if}">
				<img src="/includes/uploads/{$img.images_id}_s.jpg" />
			</a>
			<div class="status_bar">{if $img.images_status == 0}Ваша работа не проверена{elseif $img.images_status == 1}<span class="green">Ваша работа принята!</span>{elseif $img.images_status == 2}<span class="red">Ваша работа отклонена!</span>{/if}</div>
			{if $acc_self == 1}<button class="x" data="{$img.images_id}">x</button>{/if}
            </li>
            {/foreach}
            </ul>
          </div>
        {/foreach}
      {/foreach}
    </div>
  </div>
{/block}
