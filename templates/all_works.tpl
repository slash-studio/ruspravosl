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
      {if isset($subCategoryName)}<h2>{$subCategoryName}</h2>{/if}
      <ul>
         <li>
            <a href="#" class="block"><img src="/images/min1.jpg" /></a>
            <a href="#" class="user">Василий Янкин (9 лет)</a>
            <a href="#" class="likes">35</a>
         </li><li>
            <a href="#" class="block"><img src="/images/min2.jpg" /></a>
            <a href="#" class="user">Марк Тертышный (11 лет)</a>
            <a href="#" class="likes">12</a>
         </li><li>
            <a href="#" class="block"><img src="/images/min3.jpg" /></a>
            <a href="#" class="user">Александраааа Лосницкий (12 лет)</a>
            <a href="#" class="likes">9</a>
         </li><li>
            <a href="#" class="block"><img src="/images/min4.jpg" /></a>
            <a href="#" class="user">Карина Штоль (18 лет)</a>
            <a href="#" class="likes">3</a>
         </li><li>
            <a href="#" class="block"><img src="/images/min5.jpg" /></a>
            <a href="#" class="user">Василий Янкин (9 лет)</a>
            <a href="#" class="likes">35</a>
         </li><li>
            <a href="#" class="block"><img src="/images/min6.jpg" /></a>
            <a href="#" class="user">Марк Тертышный (11 лет)</a>
            <a href="#" class="likes">12</a>
         </li><li>
            <a href="#" class="block"><img src="/images/min1.jpg" /></a>
            <a href="#" class="user">Александраааа Лосницкий (12 лет)</a>
            <a href="#" class="likes">9</a>
         </li>
      </ul>
  </div>
{/block}