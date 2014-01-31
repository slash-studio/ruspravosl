{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/index.css" rel="stylesheet" />
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
  <div id="top_block">
    <section id="news">
      <img src="/images/news1.jpg" />
      <div>
        <h1>{$text.texts_text_head}</h1>
        <p>{$text.texts_text_body}</p>
        {if $competitiveStatus==1}<button id="start" type="button" onClick="javascript:location.assign('/login')">Принять участие!</button>{/if}
      </div>
    </section>
    <section class="imgs">
      {if $imgs|@count > 0}
      <h1>Конкурсные работы</h1>
      <ul>
      {foreach from=$imgs item=img}
        <li>
          <a href="/includes/uploads/{$img.images_id}_b.jpg" class="group1 block"><img src="/includes/uploads/{$img.images_id}_s.jpg" /></a>
          <a href="/profile/{$img.images_user_id}" class="user">{$img.users_name} {$img.users_surname} ({$img.users_age} лет)</a>
        </li>
      {/foreach}
      </ul>
      {/if}
    </section>
  </div>
{/block}