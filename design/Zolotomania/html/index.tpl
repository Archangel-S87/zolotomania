<!DOCTYPE html>
<html dir="ltr" prefix="og: http://ogp.me/ns#" lang="ru">
<head>
	<base href="{$config->root_url}/"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>

	<!--[if lte IE 9]><style>#container select{ padding:0; }</style><![endif]-->
	{if $module == "ProductView"}
		{* product seo title *}
			{if !empty($category->name)}{$ctg = " | "|cat:$category->name}{else}{$ctg = ''}{/if}
			{if !empty($brand->name)}{$brnd = " | "|cat:$brand->name}{else}{$brnd = ''}{/if}
			{if empty($meta_title) && !empty($product->name)}
				{$seo_title=$product->name|cat:$ctg|cat:$brnd}
			{/if}
		{* product seo description *}
			{$first_category = $category->path|first}
			{if !empty($category->seo_one)}
				{$seo_one = $category->seo_one}
			{elseif !empty($first_category->seo_one)}
				{$seo_one = $first_category->seo_one}
			{else}
				{$seo_one = ''}
			{/if}
			{if !empty($category->seo_two)}
				{$seo_two = $category->seo_two}
			{elseif !empty($first_category->seo_two)}
				{$seo_two = $first_category->seo_two}
			{else}
				{$seo_two = ''}
			{/if}
			{if isset($category->seo_type) && $category->seo_type == 1 && !empty($product->variant->price)}
				{$seo_description = $seo_one|cat:$product->name|cat:" ✩ за "|cat:($product->variant->price|convert|strip:'')|cat:" "|cat:$currency->sign|cat:$seo_two}
			{else}
				{$seo_description = $seo_one|cat:$product->name|cat:$seo_two}
			{/if}
	{else}
		{* page seo description *}
		{if !empty($meta_title)}
			{$seo_description = $meta_title|cat:$settings->seo_description|cat:" ✩ "|cat:$settings->site_name|cat:" ✩"}
		{elseif !empty($page->header)}
			{$seo_description = $page->header|cat:$settings->seo_description|cat:" ✩ "|cat:$settings->site_name|cat:" ✩"}
		{/if}
	{/if}
	<title>{if !empty($meta_title)}{$meta_title|escape}{elseif !empty($seo_title)}{$seo_title|escape}{/if}{if !empty($current_page_num) && $current_page_num>1} - страница {$current_page_num}{/if}</title>
	<meta name="description" content="{if !empty($meta_description)}{$meta_description|escape}{elseif !empty($seo_description)}{$seo_description|escape}{/if}" />
	<meta name="keywords" content="{if !empty($meta_keywords)}{$meta_keywords|escape}{/if}" />

	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2, user-scalable=yes"/>
	<meta name="format-detection" content="telephone=no"/>

	<link rel="stylesheet" type="text/css" href="design/{$settings->theme|escape}/fonts/fonts.css"/>
	<link rel="stylesheet" type="text/css" href="design/{$settings->theme|escape}/css/style.css?v={filemtime("design/{$settings->theme|escape}/css/style.css")}"/>
	<link rel="stylesheet" type="text/css" href="design/{$settings->theme|escape}/css/custom.css?v={filemtime("design/{$settings->theme|escape}/css/custom.css")}"/>

	<script src="/js/jquery/jquery-1.12.4.min.js"></script>
    <script src="design/{$settings->theme|escape}/js/mask.js"></script>
    <script src="design/{$settings->theme|escape}/js/main.js"></script>

	<!--canonical-->{if isset($canonical)}<link rel="canonical" href="{$config->root_url}{$canonical}"/>{/if}<!--/canonical-->
	{if !empty($current_page_num) && $current_page_num==2}<link rel="prev" href="{$config->root_url}{url page=null}">{/if}
	{if !empty($current_page_num) && $current_page_num>2}<link rel="prev" href="{$config->root_url}{url page=$current_page_num-1}">{/if}
	{if !empty($current_page_num) && $current_page_num<$total_pages_num}<link rel="next" href="{$config->root_url}{url page=$current_page_num+1}">{/if}
	{if !empty($current_page_num) && $current_page_num > 1}<meta name=robots content="index,follow">{/if}

	<link href="/favicon.ico" rel="icon" type="image/x-icon"/>
	<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon"/>

	{if $module == 'ProductView'}
		<meta name="twitter:url"  property="og:url" content="{$config->root_url}{$smarty.server.REQUEST_URI}">
		<meta property="og:type" content="website">
		<meta name="twitter:card" content="product"/>
		<meta name="twitter:title" property="og:title" content="{$product->name|escape}">
		<meta name="twitter:description" property="og:description" content='{if !empty($product->annotation)}{$product->annotation|strip_tags|escape}{elseif !empty($meta_description)}{$meta_description|escape}{/if}'>
		{if !empty($product->image->filename)}
			<meta name="twitter:image" property="og:image" content="{$product->image->filename|resize:800:600:w}">
			<link rel="image_src" href="{$product->image->filename|resize:800:600:w}">
		{else}
			<meta name="twitter:image" property="og:image" content="{$config->root_url}/js/nophoto.png">
			<link rel="image_src" href="{$config->root_url}/js/nophoto.png">
		{/if}
		{if !empty($settings->site_name)}
			<meta name="twitter:site" content="{$settings->site_name|escape}">
		{/if}
		{if !empty($product->variant->price)}
			<meta name="twitter:data1" content="Цена">
			<meta name="twitter:label1" content="{$product->variant->price|convert} {$currency->code|escape}">
		{/if}
		{if !empty($settings->company_name)}
			<meta name="twitter:data2" content="Организация">
			<meta name="twitter:label2" content="{$settings->company_name|escape}">
		{/if}
	{elseif in_array($module, array('BlogView', 'ArticlesView', 'SurveysView'))}
		<meta property="og:url" content="{$config->root_url}{$smarty.server.REQUEST_URI}">
		<meta property="og:type" content="article">
		<meta name="twitter:card" content="summary">
		<meta name="twitter:title" property="og:title" content="{$meta_title|escape}">
		{if !empty($post->image)}
			<meta name="twitter:image" property="og:image" content="{$post->image->filename|resize:400:400}">
			<link rel="image_src" href="{$post->image->filename|resize:400:400}">
		{elseif !empty($post->images[1])}
			<meta name="twitter:image" property="og:image" content="{$post->images[1]->filename|resize:800:600:w}">
			<link rel="image_src" href="{$post->images[1]->filename|resize:800:600:w}">
		{else}
			<meta name="twitter:image" property="og:image" content="{$config->root_url}/files/logo/logo.svg">
			<link rel="image_src" href="{$config->root_url}/files/logo/logo.svg">
		{/if}
		<meta name="twitter:description" property="og:description" content="{if !empty($post->annotation)}{$post->annotation|strip_tags|escape}{elseif !empty($meta_description)}{$meta_description|escape}{/if}">
	{else}
		<meta name="twitter:title" property="og:title" content="{$meta_title|escape}">
		<meta property="og:type" content="website">
		<meta name="twitter:card" content="summary">
		<meta property="og:url" content="{$config->root_url}{$smarty.server.REQUEST_URI}">
		<meta name="twitter:image" property="og:image" content="{$config->root_url}/files/logo/logo.svg">
		<link rel="image_src" href="{$config->root_url}/files/logo/logo.svg">
		<meta property="og:site_name" content="{$settings->site_name|escape}">
		{if !empty($meta_description)}<meta name="twitter:description" property="og:description" content="{$meta_description|escape}">{/if}
	{/if}
	<meta name="generator" content="Zolotomania">
	{if !empty($settings->script_header)}{$settings->script_header}{/if}
	{if $settings->analytics}
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id={$settings->analytics}"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){ dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', '{$settings->analytics}');
		</script>
	{/if}
</head>

<body {if $module}class="{$module|lower}"{/if}>
	{* header *}
	<header {if $module !== 'MainView'}class="bottom-border"{/if}>

		<div class="container flex">
			<div class="header__left">
				<div class="slogan">Сделай жизнь чуточку лучше!</div>
				{if $settings->phone}
					<div id="top_phone">
						<span class="second-level font first_phone"
							  onClick="window.location='tel:{$settings->phone|escape|replace:' ' :''}'"
							  style="cursor:pointer;">{$settings->phone|escape}</span>
					</div>
				{/if}
			</div>
			<div class="header__center">
				<img class="logo" onclick="window.location='{$config->root_url}/'" src="files/logo/logo.svg?v={filemtime('files/logo/logo.svg')}" title="{$settings->site_name|escape}" alt="{$settings->site_name|escape}" />
			</div>
			<div class="header__right">
				<div class="">
					{get_wishlist_products var=wished_products}
					<div id="wishlist" class="header-icon">
						{include file='wishlist_informer.tpl'}
					</div>
					<div id="cart_informer" class="header-icon">
						{include file='cart_informer.tpl'}
					</div>
				</div>
				<div class="" style="margin-left: 20px;">
					<a href="" class="btn">Отзывы</a>
					{if $user}
						{if $module == 'UserView'}
							<a href="/user/logout" class="btn">Выйти</a>
						{else}
							<a href="/user" class="btn">Кабинет</a>
						{/if}
					{else}
						<a href="/user" class="btn">я с вами</a>
					{/if}
				</div>
			</div>
		</div>
	</header>
	{* header end*}

	<div id="container" class="catid{if $module == 'ProductsView'}{foreach from=$category->path item=cat}{$cat->id|escape}{/foreach}{/if}" style="position:relative;z-index: 1;">
	{if $module != 'MainView'}
		<div class="side-shade2"></div>
		{$bread_pos = 1}

		{if !in_array($module, ['LoginView', 'RegisterView', 'UserView', 'WishlistView', 'CartView', 'OrderView', 'ProductsView', 'PageView', 'ServicesView'])}
			<div class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<div class="uk-container">
					{if $module == 'ProductsView'}
						{if !empty($category)}
							{foreach from=$category->path item=cat}
								{if !$cat@last || !empty($brand)}
									<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
										<a itemprop="item" href="catalog/{$cat->url}" title="{$cat->name|escape}">
											<span itemprop="name">{$cat->name|escape}</span>
										</a>
										<meta itemprop="position" content="{$bread_pos++}">
									</span>
									<span class="breadcrumb-separator">»</span>
								{else}
									<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
									<link itemprop="item" href="catalog/{$cat->url}"/>
									<span itemprop="name">{$cat->name|escape}</span>
									<meta itemprop="position" content="{$bread_pos++}">
								</span>
								{/if}
							{/foreach}
						{/if}
					{elseif $module == 'ProductView'}
						<a href="#" class="button-back" onclick="window.history.back(); return false;">
							<svg><use xlink:href='#arrow_left'/></svg>
						</a>
						{if $category}
							{foreach from=$category->path item=cat}
								<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
									<a itemprop="item" href="catalog/{$cat->url}" title="{$cat->name|escape}">
										<span itemprop="name">{$cat->name|escape}</span>
									</a>
									<meta itemprop="position" content="{$bread_pos++}">
								</span>
								<span class="breadcrumb-separator">»</span>
							{/foreach}
						{/if}
						<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
							<link itemprop="item" href="products/{$product->url}" />
							<span itemprop="name">{$product->name|escape}</span>
							<meta itemprop="position" content="{$bread_pos++}">
						</span>
					{else}
						<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
							<link itemprop="item" href="{if !empty($page->url)}{$page->url}{/if}" />
							<span itemprop="name">
								{if !empty($h1_title)}
									{$h1_title|escape}
								{elseif !empty($page->name)}
									{$page->name|escape}
								{elseif !empty($page_name)}
									{$page_name|escape}
								{/if}
							</span>
							<meta itemprop="position" content="{$bread_pos++}">
						</span>
					{/if}
				</div>
			</div>
		{/if}
	{/if}

		<div id="content" role="main" class="content_wrapper {if $module != 'MainView'} uk-container {/if}">
				{$content}
		</div>
	</div>

	<footer class="footer">
		<div class="container">
			<div class="footer__logo-wrap">
				<a href="/" class="footer__logo">
					<img class="logo" onclick="window.location='{$config->root_url}/'" src="files/logo/logo.svg?v={filemtime('files/logo/logo.svg')}" title="{$settings->site_name|escape}" alt="{$settings->site_name|escape}" />
				</a>
			</div>
			<div class="footer__info flex">
				<div class="footer__column">
					<div class="footer__column-title">О нас</div>
					<p>Ещё больше возможностей</p>
					<a class="btn npk" href="//zoloto-rezerv.ru" onclick="window.open('//zoloto-rezerv.ru'); return false;" target="_blank">
						<img src="/design/Zolotomania/images/zoloto-rezerv.png" alt="zoloto-rezerv">
						<span class="color">Ваш Золотой РезервЪ</span>
					</a>
					<a class="btn au-ag" href="//скупка-золото.рф" onclick="window.open('//скупка-золото.рф'); return false;" target="_blank">
						<span class="color">Скупка</span><span style="margin-left: 4px; font-size: 12px; color: #6D6E71;">Золото / Серебро</span>
					</a>
					<div class="text-bold">Юридическая информация</div>
					<a href="/policy">Политика конфиденциальности</a>
					<a href="/">Пользовательское соглашение</a>
					<a href="/" class="text-bold">Наши магазины</a>
					<a href="/" class="text-bold">Мы в картинках</a>
				</div>
				<div class="footer__column">
					<div class="footer__column-title">Служба клиентов</div>
					<div class="text-bold">Способы оплаты</div>
					<a href="/oplata">Карта</a>
					<a href="/pokupaj-so-sberom">Покупай со Сбером</a>
					<a href="/">Наличные</a>
					<a href="/">Обмен</a>
					<div class="text-bold">Доставка</div>
					<a href="/">Адресная</a>
					<a href="/">Магазин</a>
					<a href="/" class="text-bold">Условия обмена</a>
					<a href="/" class="text-bold">Бонусная программа</a>
					<a href="/" class="text-bold">Ремонт и изготовление</a>
					<a href="/" class="text-bold">Уход за изделиями</a>
				</div>
				<div class="footer__column">
					<div class="footer__column-title">Мы Online</div>
					<div class="text-bold">Присоединяйся</div>
					<div class="contact-profiles">
						{if $settings->twitter}
							<div title="Twitter" onclick="window.open('{$settings->twitter|escape}','_blank');" class="twitter sprite">
							</div>
						{/if}
						{if $settings->google}
							<div title="Google+" onclick="window.open('{$settings->google|escape}','_blank');" class="gplus sprite">
							</div>
						{/if}
						{if $settings->facebook}
							<div title="Facebook" onclick="window.open('{$settings->facebook|escape}','_blank');" class="facebook sprite">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.5 28.75"><path class="cls-1" d="M27.48,6.19a4.21,4.21,0,0,0-4.06-4.06H7.18A4.21,4.21,0,0,0,3.12,6.19V22.43a4.21,4.21,0,0,0,4.06,4.06H15.3V17.28h-3V13.23h3V11.65c0-2.73,2.05-5.19,4.57-5.19h3.28v4.06H19.87a1,1,0,0,0-.78,1.09v1.62h4.06v4.05H19.09v9.21h4.33a4.21,4.21,0,0,0,4.06-4.06Zm0,0"/></svg>
							</div>
						{/if}
						{if $settings->youtube}
							<div title="Youtube" onclick="window.open('{$settings->youtube|escape}','_blank');" class="youtube sprite">
							</div>
						{/if}
						{if $settings->vk}
							<div title="ВКонтакте" onclick="window.open('{$settings->vk|escape}','_blank');" class="vk sprite">
								<img src="design/{$settings->theme|escape}/images/free-icon-vk.svg" alt="vk">
							</div>
						{/if}
						{if $settings->insta}
							<div title="Instagram" onclick="window.open('{$settings->insta|escape}','_blank');" class="insta sprite">
								<img src="design/{$settings->theme|escape}/images/free-icon-instagram.svg"
									 alt="instagram">
							</div>
						{/if}
						{if $settings->odnoklassniki}
							<div title="Одноклассники" onclick="window.open('{$settings->odnoklassniki|escape}','_blank');" class="ok sprite">
								<img src="design/{$settings->theme|escape}/images/free-icon-odnoklassniki.svg" alt="odnoklassniki">
							</div>
						{/if}
					</div>
					<div class="text-bold">Напиши в чате</div>
					<div id="footer#6">
						<div class="contact-profiles">
							{if $settings->viber}
								<div title="Viber" onclick="window.open('viber://chat?number={$settings->viber}','_blank');" class="viber sprite">
									<img src="design/{$settings->theme|escape}/images/free-icon-viber.svg" alt="viber">
								</div>
							{/if}
							{if $settings->whatsapp}
								<div title="Whatsapp" onclick="window.open('https://api.whatsapp.com/send?phone={$settings->whatsapp}','_blank');" class="whatsapp sprite">
									<img src="design/{$settings->theme|escape}/images/free-icon-whatsapp.svg" alt="whatsapp">
								</div>
							{/if}
							{if $settings->telegram}
								<div title="Telegram" onclick="window.open('{$settings->telegram|escape}','_blank');" class="telegram sprite">
									<img src="design/{$settings->theme|escape}/images/free-icon-telegram.svg" alt="telegram">
								</div>
							{/if}
						</div>
					</div>
					<div class="text-bold">Обратный звонок</div>
					<div>
						{if $settings->phone && $settings->tel}
							<span class="second-level font first_phone text-bold"
								  onClick="window.location='tel:{$settings->phone|escape|replace:' ' :''}'"
								  style="cursor:pointer;">{$settings->phone|escape}</span>
							<span class="second-level font text-bold"
								  onClick="window.location='tel:{$settings->tel|escape|replace:' ' :''}'"
								  style="cursor:pointer;">{$settings->tel|escape}</span>
						{elseif $settings->phone}
							<span class="second-level font text-bold"
								  onClick="window.location='tel:{$settings->phone|escape|replace:' ' :''}'"
								  style="cursor:pointer;">{$settings->phone|escape}</span>
						{elseif $settings->tel}
							<span class="second-level font text-bold"
								  onClick="window.location='tel:{$settings->tel|escape|replace:' ' :''}'"
								  style="cursor:pointer;margin-bottom:3px;margin-left:10px;">{$settings->tel|escape}</span>
						{/if}
					</div>
					<a href="/" class="text-bold">Отзывы</a>
				</div>
			</div>

			<div class="flex footer__bottom" style="flex-direction: column; align-items: flex-end;">
				{$settings->rekvizites}
			</div>
		</div>
	</footer>

	<div id="topcontrol" title="Вверх" style="display:none;"></div>

	<div style="display:none;">{include file='backcall.tpl'}</div>

	{if $settings->popup_cart == 1}
		<script>var popup_cart = true;</script>
	{/if}
	<script src="js/plugins_min.js?v={filemtime('js/plugins_min.js')}"></script>

	{if $module == 'ProductView'}
		<script defer src="js/product.js"></script>
		<script defer src="js/superembed.min.js"></script>
		<script>$('#tab1 iframe').addClass('superembed-force')</script>
	{/if}

	{if in_array($module, array('ProductsView', 'ArticlesView', 'BlogView', 'SurveysView'))}
		{* ajax pagination *}
		<script>
			var offset_scroll = -60; // scroll top to pagination block padding
			{if $module == 'ProductsView'}var update_products = 1;{/if}
		</script>
		<script defer src="js/ajax_pagination_min.js"></script>
		{* ajax pagination end *}
		<div class="mainloader" style="display:none;">
			<div class="loaderspinner">
				<div class="cssload-loader">
					<div class="cssload-inner cssload-one"></div>
					<div class="cssload-inner cssload-two"></div>
					<div class="cssload-inner cssload-three"></div>
				</div>
			</div>
		</div>
	{/if}

	<script defer src="js/jquery/jquery.service.pack.js"></script>

	<script>
		{if $settings->b7manage == 0}
		$(window).scroll(function(){
			var top = $(this).scrollTop();
			if (top < 111) {
				$('.menu').css('position','relative');
			} else {
				$('.menu').css({ 'position':'fixed','top':'0' });
			}
		});
		{/if}

		$(document).ready(function() {
			$(".zoom").fancybox({ 'hideOnContentClick' : true });
			$(".zoom1").fancybox({ 'hideOnContentClick' : false, speedIn : 10, speedOut : 10, changeSpeed : 10});
		});

		{if $settings->trigger_id}
			{include file='retail_rocket.tpl'}
		{/if}
	</script>

	{if !empty($smarty.session.admin)}
		<script src ="js/admintooltip/admintooltip.js"></script>
		<link href="js/admintooltip/css/admintooltip.css" rel="stylesheet" type="text/css"/>
	{/if}

	{if $settings->b6manage == 1 && empty($smarty.cookies.dontgo)}
		{include file='dontgo.tpl'}
	{/if}
	{if $settings->stad == 1}
		{include file='stadn.tpl'}
	{/if}
	{if $settings->cookshow != 1 && empty($smarty.cookies.cookwarn)}
		{include file='cookie.tpl'}
	{/if}

	<div style="display:none;">
		{if $settings->counters}
			<!-- Yandex.Metrika counter --> <script> (function(m,e,t,r,i,k,a){ m[i]=m[i]||function(){ (m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym({$settings->counters}, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, ecommerce:"dataLayer" }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/{$settings->counters}" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
		{/if}
		{*{if $settings->analytics}
			<script>
				(function(i,s,o,g,r,a,m){ i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
				ga('create', '{$settings->analytics}', 'auto');
				ga('send', 'pageview');
			</script>
		{/if}*}
	</div>

	{* svg sprite *}
	<svg style="display:none;">
		<symbol id="arrow_left" viewBox="0 0 60.75 51.33">
			<g id="Слой_2" data-name="Слой 2"><g id="Слой_1-2" data-name="Слой 1"><line class="cls-1" fill="none" stroke="#414042" stroke-linecap="round" stroke-linejoin="round" stroke-width="5px" x1="4.82" y1="25.66" x2="58.25" y2="25.66"/><polyline class="cls-1" fill="none" stroke="#414042" stroke-linecap="round" stroke-linejoin="round" stroke-width="5px" points="33.83 48.83 2.5 25.66 33.83 2.5"/></g></g>
		</symbol>
		<symbol id="arrow" viewBox="0 0 24 24">
			<path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"/>
			<path d="M0-.25h24v24H0z" fill="none"/>
		</symbol>
		<symbol id="uncheckedconf" viewBox="0 0 24 24">
			<path d="M19 5v14H5V5h14m0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
			<path d="M0 0h24v24H0z" fill="none"/>
		</symbol>
		<symbol id="checkedconf" viewBox="0 0 24 24">
			<path d="M0 0h24v24H0z" fill="none"/>
			<path d="M19 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.11 0 2-.9 2-2V5c0-1.1-.89-2-2-2zm-9 14l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
		</symbol>
		<symbol id="antibotchecked" viewBox="0 0 24 24">
			<path fill="none" d="M0 0h24v24H0z"/>
			<path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
		</symbol>
		<symbol id="no_photo" viewBox="0 0 24 24">
			<circle cx="12" cy="12" r="3.2"></circle>
			<path d="M9 2L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-3.17L15 2H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"></path>
			<path d="M0 0h24v24H0z" fill="none"></path>
		</symbol>
		<symbol id="calendar" viewBox="0 0 24 24">
			<path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
			<path d="M0 0h24v24H0z" fill="none"/>
		</symbol>
		<symbol id="folder" viewBox="0 0 24 24">
			<path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"/><path d="M0 0h24v24H0z" fill="none"/>
		</symbol>
		<symbol id="views" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M16.24 7.75c-1.17-1.17-2.7-1.76-4.24-1.76v6l-4.24 4.24c2.34 2.34 6.14 2.34 8.49 0 2.34-2.34 2.34-6.14-.01-8.48zM12 1.99c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/>
		</symbol>
		<symbol id="comments_count" viewBox="0 0 24 24">
			<path d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z" />
		</symbol>
		<symbol id="arrow-rounded-left-7x11" viewBox="0 0 7 11"><path d="M6.7.3c-.4-.4-.9-.4-1.3 0L0 5.5l5.4 5.2c.4.4.9.3 1.3 0 .4-.4.4-1 0-1.3l-4-3.9 4-3.9c.4-.4.4-1 0-1.3z"></path>
		</symbol>
		<symbol id="arrow-rounded-right-7x11" viewBox="0 0 7 11"><path d="M.3 10.7c.4.4.9.4 1.3 0L7 5.5 1.6.3C1.2-.1.7 0 .3.3c-.4.4-.4 1 0 1.3l4 3.9-4 3.9c-.4.4-.4 1 0 1.3z"></path>
		</symbol>
		{if in_array($module, array('ProductsView', 'ProductView', 'MainView', 'PageView'))}
		<symbol id="activec" viewBox='0 0 24 24'>
			<path d='M12 6v3l4-4-4-4v3c-4.42 0-8 3.58-8 8 0 1.57.46 3.03 1.24 4.26L6.7 14.8c-.45-.83-.7-1.79-.7-2.8 0-3.31 2.69-6 6-6zm6.76 1.74L17.3 9.2c.44.84.7 1.79.7 2.8 0 3.31-2.69 6-6 6v-3l-4 4 4 4v-3c4.42 0 8-3.58 8-8 0-1.57-.46-3.03-1.24-4.26z'/>
			<path d='M0 0h24v24H0z' fill='none'/>
		</symbol>
		<symbol id="basec" viewBox="0 0 24 24">
			<path d="M19 8l-4 4h3c0 3.31-2.69 6-6 6-1.01 0-1.97-.25-2.8-.7l-1.46 1.46C8.97 19.54 10.43 20 12 20c4.42 0 8-3.58 8-8h3l-4-4zM6 12c0-3.31 2.69-6 6-6 1.01 0 1.97.25 2.8.7l1.46-1.46C15.03 4.46 13.57 4 12 4c-4.42 0-8 3.58-8 8H1l4 4 4-4H6z"/>
			<path d="M0 0h24v24H0z" fill="none"/>
		</symbol>
		<symbol id="activew" viewBox='0 0 24 24'>
			<path d='M0 0h24v24H0z' fill='none'/>
			<path d='M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z'/>
		</symbol>
		<symbol id="basew" viewBox='0 0 24 24'>
			<path d='M0 0h24v24H0z' fill='none'/>
			<path d='M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z'/>
		</symbol>
		{/if}

	</svg>
	{* svg sprite end *}

	{* Пользовательские формы / User forms *}
	{get_forms var=forms url=$smarty.server.REQUEST_URI}
	{if $forms}
		<!--noindex-->
		<div style="display:none;">
			{foreach $forms as $form}
				{if $form->visible}
				<div id="form{$form->id}" class="user_form">
					<div class="user_form_main">
						<div class="form-title">{$form->name|escape}</div>
						<div class="readform">
							<input name="f-subject" data-placeholder="Форма" type="hidden" value="{$form->name|escape}" />
							{$form->description}
						</div>
						{include file='conf.tpl'}
						{include file='antibot.tpl'}
						<div data-formid="form{$form->id}" class="buttonred hideablebutton">{$form->button|escape}</div>
					</div>
					<div class="form_result"></div>
				</div>
				{/if}
			{/foreach}
		</div>
		<!--/noindex-->
	{/if}
	{* Пользовательские формы / User forms end *}

	{* OnlineChat *}
	{if !empty($settings->consultant)}
		<script id="rhlpscrtg" type="text/javascript" charset="utf-8" async="async"
			src="https://web.redhelper.ru/service/main.js?c={$settings->consultant|escape}">
		</script>
	{/if}
	{* OnlineChat end *}

	{if !empty($settings->script_footer)}{$settings->script_footer}{/if}

</body>
</html>
