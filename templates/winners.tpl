{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/winners.css" rel="stylesheet" />
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
  <h1>Победители</h1>
  <div class="imgs">
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
	<h4>8 - 12</h4>
	<ul>
      <li>
		
      </li>
    </ul>
  </div>
</div>
{/block}
