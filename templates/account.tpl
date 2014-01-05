{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/account.css" rel="stylesheet" />
  <link href="/css/images.css" rel="stylesheet" />
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <div id="top_block">
    <h1>Мой аккаунт</h1>
    <span class="info">Логин: <b>{$login}</b></span>
    <span class="info">Имя: <b>{$fullname}</b></span>
    <span class="info">Адрес: <b>{$address}</b></span>
    <span class="info">Школа: <b>{$school}</b></span>
    <div class="imgs">
      <h2>Загруженные фотографии</h2>
      <ul>
        <li>
          <a href="#" class="block"><img src="/images/min1.jpg" /></a><button class="x">x</button>
          <a href="#" class="likes">9</a>
        </li><li>
          <a href="#" class="block"><img src="/images/min2.jpg" /></a><button class="x">x</button>
          <a href="#" class="likes">1</a>
        </li><li>
          
        </li>
      </ul>
      <button id="upload">Загрузить фото</button>
    </div>
    <span id="super" class="red">Ваши работы не проверены</span>
  </div>
{/block}
