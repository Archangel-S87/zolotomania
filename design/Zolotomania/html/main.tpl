{* Канонический адрес страницы *}
{$canonical="" scope=root}

<link rel="stylesheet" type="text/css" href="design/{$settings->theme|escape}/css/main.css?v={filemtime("design/{$settings->theme|escape}/css/main.css")}"/>

<div class="slidertop{if $settings->slidermode == 'tinyslider'} tinyslider{elseif $settings->slidermode == 'sideslider'} tinyslider sidebanners{/if}">
	{include file='slider.tpl'}
</div>

{if !empty($main_categories)}
	{foreach name=cats from=$main_categories item=mc}
		<div class="section main-category-wrapper">
			<div class="container">
				<div class="section-title-wrapper main-category-title-wrapper">
					<h3 class="section-title main-category-title">{$mc->name|escape}</h3>
				</div>
				<ul class="relcontent tiny_products parentscat">
					{foreach name=cats from=$mc->subcategories item=c}
						{if $c->visible && $c->products_count > 0}
							<li class="product" onClick="window.location='/catalog/{$c->url}'" style="cursor:pointer;">
								<div class="image">
									{if $c->image}
										<img loading="lazy" src="/files/categories/{$c->image}" alt="{$c->name}"
											 title="{$c->name}"/>
									{else}
										<svg class="nophoto">
											<use xlink:href='#folder'/>
										</svg>
									{/if}
								</div>
								<div class="product_info">
									<h3 class="product_title">
										<a data-category="{$c->id}" href="catalog/{$c->url}">{$c->name}</a></h3>
								</div>
							</li>
						{/if}
					{/foreach}
				</ul>
			</div>
		</div>
	{/foreach}
{/if}

{* new *}
{if $settings->mainnew}
	{* available sort (or remove): position, name, date, views, rating, rand *}
	{get_products var=is_new_products is_new_temp=1 sort=rand limit=12}
	{if !empty($is_new_products)}
		<div class="section new_carousel">
			<div class="container">
				<div class="section-title-wrapper carousel-title-wrapper">
					<h3 class="section-title carousel-title">Новинки</h3>
				</div>
				<div class="owl-carousel-wrapper">
					<div id="newcarusel" class="tiny_products hoverable owl-carousel">
						{foreach $is_new_products as $product}
							<div class="product_wrap" style="display:none;">
								<div class="product">
									<div class="image" onclick="window.location='/products/{$product->url}'" {if !empty($product->images[1]->filename)}
										onmouseover="$(this).find('img').attr('src', '{$product->images[1]->filename|resize:300:300}');"
										onmouseout="$(this).find('img').attr('src', '{$product->image->filename|resize:300:300}');"
											{/if}>
										{if !empty($product->image)}
											<img loading="lazy" src="{$product->image->filename|resize:300:300}" alt="{$product->name|escape}"
												 title="{$product->name|escape}"/>
										{else}
											<img loading="lazy" src="/design/Zolotomania/images/no-photo.png" alt="{$product->name|escape}"
												 title="{$product->name|escape}"/>
										{/if}
									</div>
									<div class="product_info product_item">
										<h3 class="product_title">
											<a title="{$product->name|escape}" data-product="{$product->id}" href="products/{$product->url}">
												{$product->name|escape}
											</a>
										</h3>
										<div class="price">
											<span class="compare_price">{if $product->variant->compare_price > 0}{$product->variant->compare_price|convert}{/if}</span>
											<span class="price">{$product->variant->price|convert}</span>
											<span class="currency">{$currency->sign|escape}{if $settings->b9manage}/<span
														class="unit">{if $product->variant->unit}{$product->variant->unit}{else}{$settings->units}{/if}</span>{/if}</span>
										</div>
									</div>
								</div>
							</div>
						{/foreach}
					</div>
					<button class="arrow_left" type="button">
						<svg><use xlink:href='#arrow-rounded-left-7x11'/></svg>
					</button>
					<button class="arrow_right" type="button">
						<svg><use xlink:href='#arrow-rounded-right-7x11'/></svg>
					</button>
				</div>
			</div>
		</div>
	{/if}
{/if}
{* new end *}

{* discounted *}
{if $settings->mainsale}
	{* available sort (or remove): position, name, date, views, rating, rand *}
	{get_products var=discounted_products discounted_temp=1 sort=rand limit=12}
	{if !empty($discounted_products)}
		<div class="section discounted_carousel">
			<div class="container">
				<div class="section-title-wrapper carousel-title-wrapper">
					<h3 class="section-title carousel-title">Акционные предложения</h3>
				</div>
				<div class="owl-carousel-wrapper">
					<div id="disccarusel" class="tiny_products hoverable owl-carousel">
						{foreach $discounted_products as $product}
							<div class="product_wrap" style="display:none;">
								<div class="product">
									<div class="image" onclick="window.location='/products/{$product->url}'" {if !empty($product->images[1]->filename)}
										onmouseover="$(this).find('img').attr('src', '{$product->images[1]->filename|resize:300:300}');"
										onmouseout="$(this).find('img').attr('src', '{$product->image->filename|resize:300:300}');"
											{/if}>
										{if !empty($product->image)}
											<img loading="lazy" src="{$product->image->filename|resize:300:300}" alt="{$product->name|escape}"
												 title="{$product->name|escape}"/>
										{else}
											<img loading="lazy" src="/design/Zolotomania/images/no-photo.png" alt="{$product->name|escape}"
												 title="{$product->name|escape}"/>
										{/if}
									</div>
									<div class="product_info product_item">
										<h3 class="product_title">
											<a title="{$product->name|escape}" data-product="{$product->id}" href="products/{$product->url}">
												{$product->name|escape}
											</a>
										</h3>
										<div class="price">
											<span class="compare_price">{if $product->variant->compare_price > 0}{$product->variant->compare_price|convert}{/if}</span>
											<span class="price">{$product->variant->price|convert}</span>
											<span class="currency">{$currency->sign|escape}{if $settings->b9manage}/<span
														class="unit">{if $product->variant->unit}{$product->variant->unit}{else}{$settings->units}{/if}</span>{/if}</span>
										</div>
									</div>
								</div>
							</div>
						{/foreach}
					</div>
					<button class="arrow_left" type="button">
						<svg><use xlink:href='#arrow-rounded-left-7x11'/></svg>
					</button>
					<button class="arrow_right" type="button">
						<svg><use xlink:href='#arrow-rounded-right-7x11'/></svg>
					</button>
				</div>
			</div>
		</div>
	{/if}
{/if}
{* discounted end *}

{* articles *}
{get_articles var=last_articles sort=position limit=4}
{if !empty($last_articles)}
	<div class="section articles">
		<div class="container">
			<div class="section-title-wrapper articles-title-wrapper">
				<h3 class="section-title articles-title">Это интересно</h3>
			</div>
			<div class="flex articles-wrapper">
				{foreach $last_articles as $post}
					<div class="article">
						<h3 class="article-title">
							{if !empty($post->text)}
								<a data-article="{$post->id}" href="article/{$post->url}" title="{$post->name|escape}">
									{$post->name|escape|truncate:80:"...":true}
								</a>
							{else}
								{$post->name|escape|truncate:80:"...":true}
							{/if}
						</h3>
					</div>
				{/foreach}
			</div>
		</div>
	</div>
{/if}
{* articles end *}

<script async src="design/{$settings->theme|escape}/js/slick191.min.js"></script>
<script>
	$(window).load(function() {
		const carousel_product_option = {
			infinite: true,
			speed: 900,
			slidesToShow: 3,
			slidesToScroll: 1,
			draggable: false,
			//touchThreshold: 40,
			arrows: false,
			responsive: [
				{
					breakpoint: 1590,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 1226,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1
					}
				}
			]
		};
		{if $settings->mainnew}
		{* new *}
		$('#newcarusel').slick(carousel_product_option);
		$('.new_carousel .arrow_left').on('click',function(){ $('#newcarusel').slick('slickPrev') });
		$('.new_carousel .arrow_right').on('click',function(){ $('#newcarusel').slick('slickNext') });
		{* new end *}
		{/if}

		{if $settings->mainsale}
		{* discounted *}
		$('#disccarusel').slick(carousel_product_option);
		$('.discounted_carousel .arrow_left').on('click',function(){ $('#disccarusel').slick('slickPrev') });
		$('.discounted_carousel .arrow_right').on('click',function(){ $('#disccarusel').slick('slickNext') });
		{* discounted end *}
		{/if}

		{if $settings->main_blog == 0}
		{* blog *}
		$('#blog_carousel .blogline').slick({
			infinite: true,
			speed: 900,
			slidesToShow: 4,
			slidesToScroll: 4,
			draggable: false,
			//touchThreshold: 40,
			arrows: false
		});
		$('.blog_carousel .arrow_left').on('click',function(){ $('#blog_carousel .blogline').slick('slickPrev') });
		$('.blog_carousel .arrow_right').on('click',function(){ $('#blog_carousel .blogline').slick('slickNext') });
		{* blog end *}
		{/if}

		{if $settings->main_articles == 0}
		{* articles *}
		$('#articles_carousel .blogline').slick({
			infinite: true,
			speed: 900,
			slidesToShow: 4,
			slidesToScroll: 4,
			draggable: false,
			//touchThreshold: 40,
			arrows: false
		});
		$('.articles_carousel .arrow_left').on('click',function(){ $('#articles_carousel .blogline').slick('slickPrev') });
		$('.articles_carousel .arrow_right').on('click',function(){ $('#articles_carousel .blogline').slick('slickNext') });
		{* articles end *}
		{/if}

	});
</script>
