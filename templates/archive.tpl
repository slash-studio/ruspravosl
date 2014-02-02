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
  <aside>
	<!--такое же меню как в олл_воркс, только есть верхний уровень и там пункты меню типа "Русь православная (2014 г.)", и отсортированы по годам, и двух подгрупп Худ. искуство и Декоратив.-П. искусство есть категория "Победители" -->
  </aside>
  <div id="top_block" class="imgs">
  <!--
      <h1>Русь православная (2014 г.) (если не указано то "Архив")</h1>
	  <h2>{if isset($mainCategoryName)}{$mainCategoryName}{else}Все работы{/if}</h2>
      {if isset($subCategoryName)}<h3>{$subCategoryName}</h3>
        {if 0<=$age && $age<=2}
          <h4>{if $age==0}8 - 12{elseif $age==1}13 - 18{elseif $age==2}19 - 30{/if} лет</h4>
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
      </ul>-->
    <h1>Русь православная (2014 г.): Победители</h1>
	<h2>Художественное искусство</h2>
	<h3>Традиции православной культуры</h3>
	<h4>8 - 12 лет</h4>
	<ul>
		<li>
			<a href="/includes/uploads/16_b.jpg" class="group1 block">
				<img src="/includes/uploads/16_s.jpg" />
			</a>
			<div class="name">"Название"</div>
			<a href="/profile/{$img.images_user_id}" class="user">{$img.users_name} {$img.users_surname} ({$img.users_age} лет)</a>
		</li>
		<li>
			<a href="/includes/uploads/16_b.jpg" class="group1 block">
				<img src="/includes/uploads/16_s.jpg" />
			</a>
			<div class="name">"Название"</div>
			<a href="/profile/{$img.images_user_id}" class="user">{$img.users_name} {$img.users_surname} ({$img.users_age} лет)</a>
		</li>
    </ul>
	<h4>8 - 12 лет</h4>
	<ul>
		<li>
			<a href="/includes/uploads/16_b.jpg" class="group1 block">
				<img src="/includes/uploads/16_s.jpg" />
			</a>
			<div class="name">"Название"</div>
			<a href="/profile/{$img.images_user_id}" class="user">{$img.users_name} {$img.users_surname} ({$img.users_age} лет)</a>
		</li>
		<li>
			<a href="/includes/uploads/16_b.jpg" class="group1 block">
				<img src="/includes/uploads/16_s.jpg" />
			</a>
			<div class="name">"Название"</div>
			<a href="/profile/{$img.images_user_id}" class="user">{$img.users_name} {$img.users_surname} ({$img.users_age} лет)</a>
		</li>
    </ul>
	<h4>8 - 12 лет</h4>
	<ul>
		<li>
			<a href="/includes/uploads/16_b.jpg" class="group1 block">
				<img src="/includes/uploads/16_s.jpg" />
			</a>
			<div class="name">"Название"</div>
			<a href="/profile/{$img.images_user_id}" class="user">{$img.users_name} {$img.users_surname} ({$img.users_age} лет)</a>
		</li>
		<li>
			<a href="/includes/uploads/16_b.jpg" class="group1 block">
				<img src="/includes/uploads/16_s.jpg" />
			</a>
			<div class="name">"Название"</div>
			<a href="/profile/{$img.images_user_id}" class="user">{$img.users_name} {$img.users_surname} ({$img.users_age} лет)</a>
		</li>
    </ul>
	<h3>Традиции православной культуры</h3>
	<h4>8 - 12 лет</h4>
	<ul>
      <li>
		
      </li>
    </ul>
  </div>
{/block}