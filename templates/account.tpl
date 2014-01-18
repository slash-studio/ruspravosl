{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/account.css" rel="stylesheet" />
  <link href="/css/images.css" rel="stylesheet" />
  <script src="/js/ajaxupload.3.5.js"></script>
  <script src="/js/upload_photo.js"></script>
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <div id="top_block">
    <h1>Мой аккаунт</h1>
    <span class="info">Логин: <b>{$login}</b></span>
    <span class="info">Имя: <b>{$fullname}</b></span>
    <span class="info">Возраст: <b>{$age}</b></span>
    <span class="info">Адрес: <b>{$address}</b></span>
    <span class="info">Школа: <b>{$school}</b></span>
    <div class="imgs">
      <h2>Загруженные фотографии</h2>
      {foreach from=$cats item=rootCat}
        <h3>{$rootCat.info.categories_name}</h3>
        {foreach from=$rootCat.subcat item=cat}
          <div>
            <h4>«{$cat.categories_name}»</h4>
            <button class="upload" data="{$id},{$cat.categories_id}">Загрузить фото</button>
            <ul>
            {foreach from=$cat.imgs_info item=img}
            <li>
            <a href="#" class="block" data="{$img.images_status}"><img src="/includes/uploads/{$img.images_id}_s.jpg" /></a><button class="x" data="{$img.images_id}">x</button>
            <a href="#" class="likes">9</a>
            </li>
            {/foreach}
            </ul>
          </div>
        {/foreach}
      {/foreach}
    </div>
    <span id="super" class="red">Ваши работы не проверены</span>
  </div>
{/block}
