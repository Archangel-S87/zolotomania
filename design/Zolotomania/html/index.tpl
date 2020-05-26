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
			{if $category->seo_type == 1 && !empty($product->variant->price)}
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
	
	<link rel="stylesheet" type="text/css" href="design/{$settings->theme|escape}/css/fonts.css"/>
	<link rel="stylesheet" type="text/css" href="design/{$settings->theme|escape}/css/style.css?v={filemtime("design/{$settings->theme|escape}/css/style.css")}"/>
	<script src="js/jquery/jquery-1.12.4.min.js"></script>
	
    <script src="design/{$settings->theme|escape}/js/mask.js"></script>
    <script src="design/{$settings->theme|escape}/js/main.js"></script>
	<link rel="stylesheet" type="text/css" href="design/{$settings->theme|escape}/css/{$settings->colortheme|escape}.css?v={filemtime("design/{$settings->theme|escape}/css/{$settings->colortheme|escape}.css")}"/>
	
	<!--canonical-->{if isset($canonical)}<link rel="canonical" href="{$config->root_url}{$canonical}"/>{/if}<!--/canonical-->
	{if !empty($current_page_num) && $current_page_num==2}<link rel="prev" href="{$config->root_url}{url page=null}">{/if}
	{if !empty($current_page_num) && $current_page_num>2}<link rel="prev" href="{$config->root_url}{url page=$current_page_num-1}">{/if}
	{if !empty($current_page_num) && $current_page_num<$total_pages_num}<link rel="next" href="{$config->root_url}{url page=$current_page_num+1}">{/if}
	{if !empty($current_page_num) && $current_page_num > 1}<meta name=robots content="index,follow">{/if}
	
	<link href="favicon.ico" rel="icon" type="image/x-icon"/>
	<link href="favicon.ico" rel="shortcut icon" type="image/x-icon"/>

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
			<meta name="twitter:image" property="og:image" content="{$config->root_url}/files/logo/logo.png">
			<link rel="image_src" href="{$config->root_url}/files/logo/logo.png">
		{/if}
		<meta name="twitter:description" property="og:description" content="{if !empty($post->annotation)}{$post->annotation|strip_tags|escape}{elseif !empty($meta_description)}{$meta_description|escape}{/if}">
	{else}
		<meta name="twitter:title" property="og:title" content="{$meta_title|escape}">
		<meta property="og:type" content="website">
		<meta name="twitter:card" content="summary">
		<meta property="og:url" content="{$config->root_url}{$smarty.server.REQUEST_URI}">
		<meta name="twitter:image" property="og:image" content="{$config->root_url}/files/logo/logo.png">
		<link rel="image_src" href="{$config->root_url}/files/logo/logo.png">
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
	<header>
     	
		{if $module == 'MainView'}

		<div class="container">
			<div class="header__right">
				<div id="top_phone">
						<div class="divider {if $settings->phone && $settings->tel}twophone{else}onephone{/if}">
							<span uk-icon="icon: receiver; ratio: 1.25"></span>
							{if $settings->phone && $settings->tel}
								<span class="second-level font first_phone" onClick="window.location='tel:{$settings->phone|escape|replace:' ' :''}'" style="cursor:pointer;">{$settings->phone|escape}</span>
								<span class="second-level font" onClick="window.location='tel:{$settings->tel|escape|replace:' ' :''}'" style="cursor:pointer;">{$settings->tel|escape}</span>
							{elseif $settings->phone}
								
								<span class="second-level font" onClick="window.location='tel:{$settings->phone|escape|replace:' ' :''}'" style="cursor:pointer;">{$settings->phone|escape}</span>
							{elseif $settings->tel}
								
								<span class="second-level font" onClick="window.location='tel:{$settings->tel|escape|replace:' ' :''}'" style="cursor:pointer;">{$settings->tel|escape}</span>
							{/if}
						</div>
				</div>
				<nav class="menu">
					<div class="inner">
						<!--ul class="super-menu">
						
							<li class="catalog_menu">
								<a href="{if $settings->purpose == 0}catalog{elseif $settings->purpose == 1}services{/if}">
								<span class="menu-icon">
									 <span></span>
									 <span></span>
									 <span></span>
								</span>
								{if $settings->purpose == 0}Каталог товаров{elseif $settings->purpose == 1}Каталог услуг{/if}</a>
								{if $settings->purpose == 0 && !empty($settings->show_nav_cat) && !empty($categories)}
									{function name=categories_tree_top level=1}
									<ul class="dropdown-menu">
										{foreach $categories as $c}
											{if $c->visible}
											<li {if !empty($c->subcategories)}class="has_subcat"{/if}>
												<a title="{$c->name|escape}" href="catalog/{$c->url}">
													<span class="cat_name">{$c->name|escape}</span>
													{if !empty($c->subcategories)}<span class="subcat_icon"><svg><use xlink:href='#arrow' /></svg></span>{/if}
												</a>
												{if !empty($c->subcategories)}
													{categories_tree_top categories=$c->subcategories level=$level+1}
												{/if}
											</li>
											{/if}
										{/foreach}
									</ul>
									{/function}
									{categories_tree_top categories=$categories}
								{/if}
							</li>

							{if $menus[17]->enabled}
							<li>
								<a href="m-info">{$menus[17]->name|escape|truncate:13:"":true}</a>
								{get_pages var="menu_info" menu_id="17"}
								{if $menu_info}
									<ul class="dropdown-menu">
										{foreach $menu_info as $p}
											<li {if $page && $page->id == $p->id}class="selected"{/if}>
												<a href="{$p->url}" title="{$p->name|escape}">{$p->name|escape}</a>
											</li>
										{/foreach}
									</ul>
								{/if}
							 </li>
							 {/if}
						</ul-->
						

						<div class="topinfowrapper">
							{if $settings->purpose == 0 || in_array($module, array('ProductView', 'ProductsView', 'CartView', 'OrderView', 'BrowsedView', 'CompareView', 'WishlistView'))}
								
								{get_wishlist_products var=wished_products}
								<span id="uiwishlist"></span>
								<div id="wishlist">
									{include file='wishlist_informer.tpl'}
								</div>
							{elseif $settings->purpose == 1 && !in_array($module, array('ProductView', 'ProductsView', 'CartView', 'OrderView', 'BrowsedView', 'CompareView', 'WishlistView'))}
								<div class="servicesheader">
									<div class="svgwrapper" title="Личный кабинет" onClick="window.location='/user'">
										<span uk-icon="icon: user; ratio: 1.25"></span>
									</div>

									<div class="svgwrapper" title="Контакты" onClick="window.location='/contacts'">
										<span uk-icon="icon:  location; ratio: 1.25"></span>
									
									</div>

									<div class="svgwrapper" title="Статьи" onClick="window.location='/articles'">
										<span uk-icon="icon:  file-text; ratio: 1.25"></span>
									</div>

									<div class="svgwrapper" title="Новости" onClick="window.location='/blog'">
										<span uk-icon="icon:  info; ratio: 1.25"></span>
									</div>
								</div>
							{/if}

						</div>
						
						<!--div id="search" style="display:table;position:relative;" role="search">
								{if $module == 'BlogView'}
								<form action="blog">
								{elseif $module == 'ArticlesView'}
								<form action="articles">
								{elseif $module == 'ServicesView'}
								<form action="services">
								{else}
									{if $settings->purpose == 0}
										<form action="products">
									{elseif $settings->purpose == 1}
										<form action="services">
									{/if}
								{/if}
									<input uk-icon="icon: search; ratio: 1.25" class="button_search" value="" type="submit"/>
									<input class="input_search newsearch" type="text" name="keyword" value="{if !empty($keyword)}{$keyword|escape}{/if}" placeholder="Поиск..." autocomplete="off"/>
								</form>
								<div class="searchchoose font">
									{if $module == 'BlogView'}
									в блоге
									{elseif $module == 'ArticlesView'}
									в статьях
									{elseif $module == 'ServicesView'}
									в услугах
									{else}
										{if $settings->purpose == 0}
										в товарах
										{elseif $settings->purpose == 1}
										в услугах
										{/if}
									{/if}
								</div>
								<ul class="listsearch font" style="display:none;">
									<li data-type="blog">в блоге</li>
									<li data-type="articles">в статьях</li>
									<li data-type="services">в услугах</li>
									<li data-type="products">в товарах</li>
								</ul>
						</div-->

					</div>
					<div class="cart fixed-cart" onClick="window.location='/cart'" style="cursor:pointer;">
							<div class="cart__icon"></div>
						
							<div id="cart_informer">
								{include file='cart_informer.tpl'}
							</div>
					</div>
				</nav>
				<div id="welcome">
					<span uk-icon="icon: user; ratio: 1.25"></span>
					{if $user}
						<span class="username" onclick="window.location='/user'">Кабинет</span> 
						<span class="hline">|</span>
						<span class="username" onclick="window.location='/user/logout'">Выйти</span> 
					{else}
						<span class="username" onclick="window.location='/user/login'">Вход</span>
						<span class="hline">|</span> 
						<span class="username" onclick="window.location='/user/register'">Регистрация</span>
					{/if}
				</div>

						
						
				
			</div>
		</div>

		<div class="MainView__header" style="background: url(files/tiffany-two-models-1.jpg);">
			<div class="MainView__header-content">
				<div class="header__logo" onclick="window.location='{$config->root_url}/'">
					<span class="header__logo--big">З</span>олото<span class="header__logo--big">М</span>ания<sup>®</sup>
					<span class="header__logo--sub">первый ювелирный</span>
				</div>
				<!--img class="logo" onclick="window.location='{$config->root_url}/'" src="files/logo/logo.svg?v={filemtime('files/logo/logo.svg')}" title="{$settings->site_name|escape}" alt="{$settings->site_name|escape}" /-->
				<h1 class="MainView__header--title"> Подарки  </h1>
				<h2 class="MainView__header--subtitle">для любимых  </h2>
			</div>
			
		</div>
		
		{/if}
		{if $module != 'MainView'}
		<div class="container flex">
			<div class="header__left">
				<img class="logo" onclick="window.location='{$config->root_url}/'" src="files/logo/logo.svg?v={filemtime('files/logo/logo.svg')}" title="{$settings->site_name|escape}" alt="{$settings->site_name|escape}" />
			</div>
			<div class="header__right">
				<div id="top_phone">
						<div class="divider {if $settings->phone && $settings->tel}twophone{else}onephone{/if}">
							<span uk-icon="icon: receiver; ratio: 1.25"></span>
							{if $settings->phone && $settings->tel}
								<span class="second-level font first_phone" onClick="window.location='tel:{$settings->phone|escape|replace:' ' :''}'" style="cursor:pointer;">{$settings->phone|escape}</span>
								<span class="second-level font" onClick="window.location='tel:{$settings->tel|escape|replace:' ' :''}'" style="cursor:pointer;">{$settings->tel|escape}</span>
							{elseif $settings->phone}
								
								<span class="second-level font" onClick="window.location='tel:{$settings->phone|escape|replace:' ' :''}'" style="cursor:pointer;">{$settings->phone|escape}</span>
							{elseif $settings->tel}
								
								<span class="second-level font" onClick="window.location='tel:{$settings->tel|escape|replace:' ' :''}'" style="cursor:pointer;">{$settings->tel|escape}</span>
							{/if}
						</div>
				</div>
				<nav class="menu">
					<div class="inner">
						<!--ul class="super-menu">
						
							<li class="catalog_menu">
								<a href="{if $settings->purpose == 0}catalog{elseif $settings->purpose == 1}services{/if}">
								<span class="menu-icon">
									 <span></span>
									 <span></span>
									 <span></span>
								</span>
								{if $settings->purpose == 0}Каталог товаров{elseif $settings->purpose == 1}Каталог услуг{/if}</a>
								{if $settings->purpose == 0 && !empty($settings->show_nav_cat) && !empty($categories)}
									{function name=categories_tree_top level=1}
									<ul class="dropdown-menu">
										{foreach $categories as $c}
											{if $c->visible}
											<li {if !empty($c->subcategories)}class="has_subcat"{/if}>
												<a title="{$c->name|escape}" href="catalog/{$c->url}">
													<span class="cat_name">{$c->name|escape}</span>
													{if !empty($c->subcategories)}<span class="subcat_icon"><svg><use xlink:href='#arrow' /></svg></span>{/if}
												</a>
												{if !empty($c->subcategories)}
													{categories_tree_top categories=$c->subcategories level=$level+1}
												{/if}
											</li>
											{/if}
										{/foreach}
									</ul>
									{/function}
									{categories_tree_top categories=$categories}
								{/if}
							</li>

							{if $menus[17]->enabled}
							<li>
								<a href="m-info">{$menus[17]->name|escape|truncate:13:"":true}</a>
								{get_pages var="menu_info" menu_id="17"}
								{if $menu_info}
									<ul class="dropdown-menu">
										{foreach $menu_info as $p}
											<li {if $page && $page->id == $p->id}class="selected"{/if}>
												<a href="{$p->url}" title="{$p->name|escape}">{$p->name|escape}</a>
											</li>
										{/foreach}
									</ul>
								{/if}
							 </li>
							 {/if}
						</ul-->
						

						<div class="topinfowrapper">
							{if $settings->purpose == 0 || in_array($module, array('ProductView', 'ProductsView', 'CartView', 'OrderView', 'BrowsedView', 'CompareView', 'WishlistView'))}
								
								{get_wishlist_products var=wished_products}
								<span id="uiwishlist"></span>
								<div id="wishlist">
									{include file='wishlist_informer.tpl'}
								</div>
							{elseif $settings->purpose == 1 && !in_array($module, array('ProductView', 'ProductsView', 'CartView', 'OrderView', 'BrowsedView', 'CompareView', 'WishlistView'))}
								<div class="servicesheader">
									<div class="svgwrapper" title="Личный кабинет" onClick="window.location='/user'">
										<span uk-icon="icon: user; ratio: 1.25"></span>
									</div>

									<div class="svgwrapper" title="Контакты" onClick="window.location='/contacts'">
										<span uk-icon="icon:  location; ratio: 1.25"></span>
									
									</div>

									<div class="svgwrapper" title="Статьи" onClick="window.location='/articles'">
										<span uk-icon="icon:  file-text; ratio: 1.25"></span>
									</div>

									<div class="svgwrapper" title="Новости" onClick="window.location='/blog'">
										<span uk-icon="icon:  info; ratio: 1.25"></span>
									</div>
								</div>
							{/if}

						</div>
						
						<!--div id="search" style="display:table;position:relative;" role="search">
								{if $module == 'BlogView'}
								<form action="blog">
								{elseif $module == 'ArticlesView'}
								<form action="articles">
								{elseif $module == 'ServicesView'}
								<form action="services">
								{else}
									{if $settings->purpose == 0}
										<form action="products">
									{elseif $settings->purpose == 1}
										<form action="services">
									{/if}
								{/if}
									<input uk-icon="icon: search; ratio: 1.25" class="button_search" value="" type="submit"/>
									<input class="input_search newsearch" type="text" name="keyword" value="{if !empty($keyword)}{$keyword|escape}{/if}" placeholder="Поиск..." autocomplete="off"/>
								</form>
								<div class="searchchoose font">
									{if $module == 'BlogView'}
									в блоге
									{elseif $module == 'ArticlesView'}
									в статьях
									{elseif $module == 'ServicesView'}
									в услугах
									{else}
										{if $settings->purpose == 0}
										в товарах
										{elseif $settings->purpose == 1}
										в услугах
										{/if}
									{/if}
								</div>
								<ul class="listsearch font" style="display:none;">
									<li data-type="blog">в блоге</li>
									<li data-type="articles">в статьях</li>
									<li data-type="services">в услугах</li>
									<li data-type="products">в товарах</li>
								</ul>
						</div-->

					</div>
					<div class="cart fixed-cart" onClick="window.location='/cart'" style="cursor:pointer;">
							<div class="cart__icon"></div>
						
							<div id="cart_informer">
								{include file='cart_informer.tpl'}
							</div>
					</div>
				</nav>
				<div id="welcome">
					<span uk-icon="icon: user; ratio: 1.25"></span>
					{if $user}
						<span class="username" onclick="window.location='/user'">Кабинет</span> 
						<span class="hline">|</span>
						<span class="username" onclick="window.location='/user/logout'">Выйти</span> 
					{else}
						<span class="username" onclick="window.location='/user/login'">Вход</span>
						<span class="hline">|</span> 
						<span class="username" onclick="window.location='/user/register'">Регистрация</span>
					{/if}
				</div>

						
						
				
			</div>	
		</div>	
		{/if}
	</header>
	{* header end*}
	
	

	<div id="container" class="catid{if $module == 'ProductsView'}{foreach from=$category->path item=cat}{$cat->id|escape}{/foreach}{/if}">
		{if $module != 'MainView'}
			<div class="side-shade2"></div>
			{$bread_pos = 1}
			{if $module == 'ProductView'}
			<div class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<div class="uk-container">
					<span class="home" itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemprop="item" href="/" title="Главная"><svg viewBox="0 0 486.988 486.988" width="16px" height="16px"><path fill="currentColor" d="M16.822,284.968h39.667v158.667c0,9.35,7.65,17,17,17h116.167c9.35,0,17-7.65,17-17V327.468h70.833v116.167c0,9.35,7.65,17,17,17h110.5c9.35,0,17-7.65,17-17V284.968h48.167c6.8,0,13.033-4.25,15.583-10.483c2.55-6.233,1.133-13.6-3.683-18.417L260.489,31.385c-6.517-6.517-17.283-6.8-23.8-0.283L5.206,255.785c-5.1,4.817-6.517,12.183-3.967,18.7C3.789,281.001,10.022,284.968,16.822,284.968zM248.022,67.368l181.333,183.6h-24.367c-9.35,0-17,7.65-17,17v158.667h-76.5V310.468c0-9.35-7.65-17-17-17H189.656c-9.35,0-17,7.65-17,17v116.167H90.489V267.968c0-9.35-7.65-17-17-17H58.756L248.022,67.368z"></path></svg><link itemprop="name" content="Главная" /></a><meta itemprop="position" content="{$bread_pos++}"></span>
					{if $module == 'ProductsView'}
						{if !empty($category)}
							{foreach from=$category->path item=cat}
							{if !$cat@last || !empty($brand)}
								<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemprop="item" href="catalog/{$cat->url}" title="{$cat->name|escape}"><span itemprop="name">{$cat->name|escape}</span></a><meta itemprop="position" content="{$bread_pos++}"></span>
							{else}
								<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="catalog/{$cat->url}" /><span itemprop="name">{$cat->name|escape}</a><meta itemprop="position" content="{$bread_pos++}"></span>
							{/if}
							{/foreach}  
							{if !empty($brand)}
								<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="catalog/{$cat->url}/{$brand->url}" /><span itemprop="name">{$brand->name|escape}</a><meta itemprop="position" content="{$bread_pos++}"></span>
							{/if}
						{elseif !empty($brand)}
								<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemprop="item" href="brands" title="Бренды"><span itemprop="name">Бренды</span></a><meta itemprop="position" content="{$bread_pos++}"></span>
								<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="brands/{$brand->url}" /><span itemprop="name">{$brand->name|escape}</a><meta itemprop="position" content="{$bread_pos++}"></span>
						{elseif !empty($keyword)}
							Поиск
						{/if}
					{elseif $module == 'ProductView'}
						{if $category}{foreach from=$category->path item=cat}
							<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemprop="item" href="catalog/{$cat->url}" title="{$cat->name|escape}"><span itemprop="name">{$cat->name|escape}</span></a><meta itemprop="position" content="{$bread_pos++}"></span>
						{/foreach}{/if}
						{if !empty($brand)}
							<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemprop="item" href="catalog/{$cat->url}/{$brand->url}" title="{$brand->name|escape}"><span itemprop="name">{$brand->name|escape}</span></a><meta itemprop="position" content="{$bread_pos++}"></span>
						{/if}
							<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="products/{$product->url}" /><span itemprop="name">{$product->name|escape}</a><meta itemprop="position" content="{$bread_pos++}"></span>
					{elseif $module == 'ArticlesView'}
						{if isset($page) && $page->url == 'articles'}
							<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="articles" /><span itemprop="name">Статьи</a><meta itemprop="position" content="{$bread_pos++}"></span>
						{else}
							<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemprop="item" href="articles"><span itemprop="name">Статьи</span></a><meta itemprop="position" content="{$bread_pos++}"></span> 
						{/if}
						{if !empty($category)}
							{foreach from=$category->path item=cat}
							{if !$cat@last || !empty($post->name)}
								<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemprop="item" href="articles/{$cat->url}" title="{$cat->name|escape}"><span itemprop="name">{$cat->name|escape}</span></a><meta itemprop="position" content="{$bread_pos++}"></span>
							{else}
								<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="articles/{$cat->url}" /><span itemprop="name">{$cat->name|escape}</a><meta itemprop="position" content="{$bread_pos++}"></span>
							{/if}
							{/foreach}
						{/if}
						{if !empty($post->name)} » <span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="article/{$post->url}" /><span itemprop="name">{$post->name|escape}</a><meta itemprop="position" content="{$bread_pos++}"></span>{/if}
					{elseif $module == 'ServicesView'}
						{if isset($page) && $page->url == 'services'}
							<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="services" /><span itemprop="name">Услуги</a><meta itemprop="position" content="{$bread_pos++}"></span>
						{else}
							» <span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemprop="item" href="services" title="Услуги"><span itemprop="name">Услуги</span></a><meta itemprop="position" content="{$bread_pos++}"></span> 
						{/if}
						{if !empty($category)}
							{foreach from=$category->path item=cat}
							{if !$cat@last}
								<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemprop="item" href="services/{$cat->url}" title="{$cat->name|escape}"><span itemprop="name">{$cat->name|escape}</span></a><meta itemprop="position" content="{$bread_pos++}"></span>
							{else}
								<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="services/{$cat->url}" /><span itemprop="name">{$cat->name|escape}</a><meta itemprop="position" content="{$bread_pos++}"></span>
							{/if}
							{/foreach}
						{/if}
					{elseif $module == 'SurveysView'}
						 » 
						<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemprop="item" href="/surveys"><span itemprop="name">Задания</span></a><meta itemprop="position" content="{$bread_pos++}"></span> 
						{if !empty($category)}
							{foreach from=$category->path item=cat}
							{if !$cat@last || !empty($survey->name)}
								<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemprop="item" href="surveys/{$cat->url}" title="{$cat->name|escape}"><span itemprop="name">{$cat->name|escape}</span></a><meta itemprop="position" content="{$bread_pos++}"></span>
							{else}
								<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="surveys/{$cat->url}" /><span itemprop="name">{$cat->name|escape}</a><meta itemprop="position" content="{$bread_pos++}"></span>
							{/if}
							{/foreach}
						{/if}
						{if !empty($survey->name)} » <span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="/survey/{$survey->url}" /><span itemprop="name">{$survey->name|escape}</a><meta itemprop="position" content="{$bread_pos++}"></span>{/if}
					{elseif $module == 'BlogView'}
						{if isset($page) && $page->url == 'blog'}
							<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="blog" /><span itemprop="name">Блог</a><meta itemprop="position" content="{$bread_pos++}"></span>
						{else}
							<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemprop="item" href="blog" title="Блог"><span itemprop="name">Блог</span></a><meta itemprop="position" content="{$bread_pos++}"></span>
						{/if}
						{if !empty($category) && !empty($post->name)}
							<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemprop="item" href="sections/{$category->url}" title="{$category->name|escape}"><span itemprop="name">{$category->name|escape}</span></a><meta itemprop="position" content="{$bread_pos++}"></span>
						{elseif !empty($category->name)}
							<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="sections/{$category->url}" /><span itemprop="name">{$category->name|escape}</a><meta itemprop="position" content="{$bread_pos++}"></span>
						{/if}   
						{if !empty($post->name)} » <span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="blog/{$post->url}" /><span itemprop="name">{$post->name|escape}</a><meta itemprop="position" content="{$bread_pos++}"></span>{/if}
					{elseif $module == 'TagsView'}
						{if empty($keyword)}
							<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="tags" /><span itemprop="name">Хэштеги</a><meta itemprop="position" content="{$bread_pos++}"></span>
						{else}
							<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a itemprop="item" href="tags" title="Хэштеги"><span itemprop="name">Хэштеги</span></a><meta itemprop="position" content="{$bread_pos++}"></span>
							<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="tags?keyword={$keyword|escape}" /><span itemprop="name">{$keyword|escape}</a><meta itemprop="position" content="{$bread_pos++}"></span>
						{/if}
					{else} 
						<span itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem"><link itemprop="item" href="{if !empty($page->url)}{$page->url}{/if}" /><span itemprop="name">{if !empty($h1_title)}{$h1_title|escape}{elseif !empty($page->name)}{$page->name|escape}{elseif !empty($page_name)}{$page_name|escape}{/if}</a><meta itemprop="position" content="{$bread_pos++}"></span>
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
		<div class="container flex">
			
				
					<div class="footer__column">
    					<div class="uk-panel uk-margin-remove-first-child  uk-margin-remove-top">
    					    <div class="uk-child-width-expand uk-grid-column-small uk-flex-middle uk-grid" uk-grid="">
    					    	<div class="uk-width-auto@m uk-first-column">
    					    		<img class="footer__logo logo" onclick="window.location='{$config->root_url}/'" src="files/logo/logo.svg?v={filemtime('files/logo/logo.svg')}" title="{$settings->site_name|escape}" alt="{$settings->site_name|escape}" />
    					    	</div>
    					    	
                			</div>
						</div>

						
            		</div>

					

					<div class="footer__column">
						<div class="uk-h4" id="footer#5">
							{if $settings->phone && $settings->tel}
								<span class="second-level font first_phone" onClick="window.location='tel:{$settings->phone|escape|replace:' ' :''}'" style="cursor:pointer;">{$settings->phone|escape}</span>
								<span class="second-level font" onClick="window.location='tel:{$settings->tel|escape|replace:' ' :''}'" style="cursor:pointer;">{$settings->tel|escape}</span>
							{elseif $settings->phone}
								
								<span class="second-level font" onClick="window.location='tel:{$settings->phone|escape|replace:' ' :''}'" style="cursor:pointer;">{$settings->phone|escape}</span>
							{elseif $settings->tel}
								
								<span class="second-level font" onClick="window.location='tel:{$settings->tel|escape|replace:' ' :''}'" style="cursor:pointer;">{$settings->tel|escape}</span>
							{/if}
						</div>
						<div id="footer#6">
							<div class="contact-profiles">
								{if $settings->twitter}<div title="Twitter" onclick="window.open('{$settings->twitter|escape}','_blank');" class="twitter sprite"></div>{/if}
								{if $settings->google}<div title="Google+" onclick="window.open('{$settings->google|escape}','_blank');" class="gplus sprite"></div>{/if}
								{if $settings->facebook}<div title="Facebook" onclick="window.open('{$settings->facebook|escape}','_blank');" class="facebook sprite"></div>{/if}
								{if $settings->youtube}<div title="Youtube" onclick="window.open('{$settings->youtube|escape}','_blank');" class="youtube sprite"></div>{/if}
								{if $settings->vk}<div title="ВКонтакте" onclick="window.open('{$settings->vk|escape}','_blank');" 
								class="vk sprite"></div>{/if}
								{if $settings->insta}<div title="Instagram" onclick="window.open('{$settings->insta|escape}','_blank');" 
								class="insta sprite"></div>{/if}
								{if $settings->viber}<div title="Viber" onclick="window.open('viber://chat?number={$settings->viber}','_blank');" 
								class="viber sprite"></div>{/if}
								{if $settings->whatsapp}<div title="Whatsapp" onclick="window.open('https://api.whatsapp.com/send?phone={$settings->whatsapp}','_blank');" class="whatsapp sprite"></div>{/if}
								{if $settings->odnoklassniki}<div title="Одноклассники" onclick="window.open('{$settings->odnoklassniki|escape}','_blank');" class="ok sprite"></div>{/if}
								{if $settings->telegram}<div title="Telegram" onclick="window.open('{$settings->telegram|escape}','_blank');" class="telegram sprite"></div>{/if}
							</div>
						</div>
					</div>
					<div class="footer__column">
						
						<ul class="footer__list footer__adress">
							<li class="footer__adress--item">Курск, Красная площадь, 2\4</li>
							
						</ul>
						<a class="footer__adress--all button" href="/adresa-magazinov">Все магазины</a>
					</div>

					
				
		<div class="footer__bottom">
  			{if $menus[17]->enabled}
							{get_pages var="menu_1" menu_id=17}
							{if $menu_1}
							<ul class="footer__list footer__menu flex">
								{foreach $menu_1 as $p}
								<li {if $page && $page->id == $p->id}class="selected"{/if} class="footer__menu">
									<a data-page="{$p->id}" href="{$p->url}" title="{$p->name|escape}">{$p->name|escape}</a>
								</li>
								{/foreach}
							</ul>
							{/if}
						{/if}
  		</div>	
		</div>
  		
	</footer>
	
	<div id="topcontrol" title="Вверх" style="display:none;"></div>

	<script>
		{* // вариант блокировки Советника 1
			$( "*" ).each(function( ) { 
				if ($(this).attr("itemprop")) { $(this).removeAttr("itemprop"); }
			});
		*}
		{* // вариант блокировки Советника 2
		!function(){ var t=document.createElement("script");t.async=!0;var e=(new Date).getDate();t.src=("https:"==document.location.protocol?"https:":"http:")+"//blocksovetnik.ru/bs.min.js?r="+e;var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(t,n)}();
		*}
	</script>

	<div style="display:none;">{include file='backcall.tpl'}</div>

	{if $module == 'MainView'}
		<script async src="design/{$settings->theme|escape}/js/slick191.min.js"></script>
		<script>
			$(window).load(function(){
					{if $settings->mainhits}
					{* hits *}			
							$('#hitcarusel').slick({ 
							  {if $settings->addfield2}arrows:false,{/if}
							  infinite: true,
							  speed: 900,
							  slidesToShow: 6,
							  slidesToScroll: 1,
							  autoplay: true,
							  autoplaySpeed: 4000,
							  draggable: false,
							  //touchThreshold: 40,
							  arrows: false,
							  responsive: [
								{ 
								  breakpoint: 1590,
								  settings: {
									slidesToShow: 5,
									slidesToScroll: 1
								  }
								},
								{ 
								  breakpoint: 1226,
								  settings: {
									slidesToShow: 4,
									slidesToScroll: 1
								  }
								}
							  ]
							});
							$('.hits_carousel .arrow_left').on('click',function(){ $('#hitcarusel').slick('slickPrev') });
							$('.hits_carousel .arrow_right').on('click',function(){ $('#hitcarusel').slick('slickNext') });
					{* hits end *}
					{/if}
				
					{if $settings->mainnew}
					{* new *}
							$('#newcarusel').slick({ 
							  {if $settings->mainnew || $settings->addfield2}arrows:false,{/if}
							  infinite: true,
							  speed: 900,
							  slidesToShow: 6,
							  slidesToScroll: 1,
							  autoplay: true,
							  autoplaySpeed: 4000,
							  draggable: false,
							  //touchThreshold: 40,
							  arrows: false,
							  responsive: [
							  { 
								  breakpoint: 1590,
								  settings: {
									slidesToShow: 5,
									slidesToScroll: 1
								  }
								},
								{ 
								  breakpoint: 1226,
								  settings: {
									slidesToShow: 4,
									slidesToScroll: 1
								  }
								}
							  ]
							});
							$('.new_carousel .arrow_left').on('click',function(){ $('#newcarusel').slick('slickPrev') });
							$('.new_carousel .arrow_right').on('click',function(){ $('#newcarusel').slick('slickNext') });
					{* new end *}
					{/if}
				
					{if $settings->mainsale}
					{* discounted *}
							$('#disccarusel').slick({ 
							  infinite: true,
							  speed: 900,
							  slidesToShow: 6,
							  slidesToScroll: 1,
							  autoplay: true,
							  autoplaySpeed: 4000,
							  draggable: false,
							  //touchThreshold: 40,
							  arrows: false,
							  responsive: [
							  { 
								  breakpoint: 1590,
								  settings: {
									slidesToShow: 5,
									slidesToScroll: 1
								  }
								},
								{ 
								  breakpoint: 1226,
								  settings: {
									slidesToShow: 4,
									slidesToScroll: 1
								  }
								}
							  ]
							});
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
	{/if}
	

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

		$(function() {
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
