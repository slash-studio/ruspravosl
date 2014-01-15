{extends file='page.tpl'}
{block name='links' append}
	<link href="/css/header.css" rel="stylesheet" />
	<link href="/css/footer.css" rel="stylesheet" />
	<link href="/css/index.css" rel="stylesheet" />
	<link href="/css/images.css" rel="stylesheet" />
{/block}
{block name='div.main'}
	{include file="header.tpl"}
	<div id="top_block">
		<section id="news">
			<img src="/images/news1.jpg" />
			<div>
				<h1>{$mainNews[0].main_news_text_head}</h1>
				<p>{$mainNews[0].main_news_text_body}</p>
				<button id="start" type="button" onClick="javascript:location.assign('/login')">Принять участие!</button>
			</div>
		</section>
		<section class="imgs">
			<h1>Популярные работы</h1>
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
				</li>
			</ul>
		</section>
	</div>
{/block}