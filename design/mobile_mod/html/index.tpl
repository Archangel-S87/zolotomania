<!DOCTYPE html>
<html dir="ltr" lang="ru" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
	<base href="{$config->root_url}/"/>
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
	
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=yes"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>

	<!--canonical-->{if isset($canonical)}<link rel="canonical" href="{$config->root_url}{$canonical}"/>{/if}<!--/canonical-->
	{if !empty($current_page_num) && $current_page_num==2}<link rel="prev" href="{$config->root_url}{url page=null}">{/if}
	{if !empty($current_page_num) && $current_page_num>2}<link rel="prev" href="{$config->root_url}{url page=$current_page_num-1}">{/if}
	{if !empty($current_page_num) && $current_page_num<$total_pages_num}<link rel="next" href="{$config->root_url}{url page=$current_page_num+1}">{/if}
	{if !empty($current_page_num) && $current_page_num > 1}<meta name=robots content="index,follow">{/if}
	
	<meta name="theme-color" content="#{$mobtheme->colorPrimaryDark}"/>
	<style>
		@font-face {
			font-family: 'Golos Text';
			src: url('/fonts/GolosText-Medium.woff2') format('woff2'),
					url('/fonts/GolosText-Medium.woff') format('woff'),
					url('/fonts/GolosText-Medium.ttf') format('truetype');
			font-weight: 500;
			font-style: normal;
			font-display: swap;
		}
		@font-face {
			font-family: 'Golos Text';
			src: url('/fonts/GolosText-Black.woff2') format('woff2'),
					url('/fonts/GolosText-Black.woff') format('woff'),
					url('/fonts/GolosText-Black.ttf') format('truetype');
			font-weight: 900;
			font-style: normal;
			font-display: swap;
		}

		@font-face {
			font-family: 'Golos Text';
			src: url('/fonts/GolosText-Regular.woff2') format('woff2'),
					url('/fonts/GolosText-Regular.woff') format('woff'),
					url('/fonts/GolosText-Regular.ttf') format('truetype');
			font-weight: normal;
			font-style: normal;
			font-display: swap;
		}

		@font-face {
			font-family: 'Golos Text';
			src: url('/fonts/GolosText-Bold.woff2') format('woff2'),
					url('/fonts/GolosText-Bold.woff') format('woff'),
					url('/fonts/GolosText-Bold.ttf') format('truetype');
			font-weight: bold;
			font-style: normal;
			font-display: swap;
		}

		@font-face {
			font-family: 'Golos Text';
			src: url('/fonts/GolosText-DemiBold.woff2') format('woff2'),
					url('/fonts/GolosText-DemiBold.woff') format('woff'),
					url('/fonts/GolosText-DemiBold.ttf') format('truetype');
			font-weight: 600;
			font-style: normal;
			font-display: swap;
		}
	
		@font-face {
			font-family: 'Oranienbaum';
			src: url('/fonts/Oranienbaum-Regular.woff2') format('woff2'),
					url('/fonts/Oranienbaum-Regular.woff') format('woff'),
					url('/fonts/Oranienbaum-Regular.ttf') format('truetype');
			font-weight: normal;
			font-style: normal;
			font-display: swap;
		}


	</style>
	{* <link rel="stylesheet" type="text/css" href="design/mobile_mod/css/style_old.css?v={filemtime('design/mobile_mod/css/style_old.css')}"/> *}
	<link rel="stylesheet" type="text/css" href="design/mobile_mod/css/style.css?v={filemtime('design/mobile_mod/css/style.css')}"/>
	{if $module == 'SurveysView'}
		<link rel="stylesheet" type="text/css" href="design/mobile_mod/css/survey.css?v={filemtime("design/mobile_mod/css/survey.css")}"/>
	{/if}
	<link href="favicon.ico" rel="icon"          type="image/x-icon"/>
	<link href="favicon.ico" rel="shortcut icon" type="image/x-icon"/>
	<link href="favicon.ico" rel="apple-touch-icon">
	<meta name="format-detection" content="telephone=no">
	
	{* social *}
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
	{* social end *}
	{if !empty($settings->script_header)}{$settings->script_header}{/if}
	<script src="js/jquery/jquery-1.12.4.min.js"></script>
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

<body id="body" {if in_array($module, array('MainView', 'ProductsView', 'WishlistView')) || (!empty($page->url) && $page->url == 'catalog')}class="nonwhitebg"{/if}>

	{if empty($mobile_app)}
		{include file='toolbar.tpl'}
	{/if}

	{if $module != 'MainView'}
	
		<div class="breadcrumb" {if $module=='ProductView'}style="justify-content: flex-end;"{/if}>
			{if $module=='ProductsView'}
				{if !empty($category->name)}
					{if empty($category->subcategories)}
						<a href="/catalog" onclick="window.history.back(); return false;">
							<svg><use xlink:href='#arrow_left'/></svg>
						</a>
					{/if}
				{/if} 
			{/if} 
			<h1 id="uphere" {if $module == 'SurveysView' && empty($user->id)}blured {/if}>
				<!--h1-->
				{if !empty($h1_title)}
					{$h1_title|escape}
				{else}
					{if !empty($keyword)}Поиск по "{$keyword|escape}"
					{elseif !empty($page->header)}{$page->header|escape}
					{elseif !empty($page_name)}{$page_name|escape}
					{elseif !empty($page->name)}{$page->name|escape}
					{else}
						{if in_array($module, array('BlogView', 'ArticlesView', 'ServicesView'))}
							{if !empty($post->name)}{$post->name|escape}
							{elseif !empty($category->name)}{$category->name|escape}
							{/if}
						{elseif $module=='SurveysView'}
							{if !empty($survey->name)}{$survey->name|escape}
							{elseif !empty($category->name)}{$category->name|escape}
							{/if}
						{elseif $module=='ProductsView'}
							{if !empty($category->name)}						
								{$category->name|escape}
							{/if} 
							{if !empty($brand->name)}{$brand->name|escape}{/if}
						{/if}
					{/if}
				{/if}
				<!--/h1-->
			</h1>
			{if $module=='ProductsView'}
				{if !empty($category->name)}
					{if empty($category->subcategories)}
						{include file='cfeatures.tpl'}
					{/if}
				{/if} 
			{elseif $module=='ProductView'}
				<a href="/" onclick="window.history.back(); return false;">
					<svg><use xlink:href='#arrow_left'/></svg>
				</a>
			{/if} 
		</div>
	{/if}

	<div id="container" {if $module == 'SurveysView' && empty($user->id)}class="blured"{/if}>
		<div id="content" {if $module}class="{$module|lower}"{/if}>
			{$content}
		</div>
	</div>
	{* Footer *}
	<footer>
		<div class="row">
			<div id="logo">
				<img onclick="window.location='/'" src="design/mobile_mod/images/logo.svg" title="{$settings->site_name|escape}" alt="{$settings->site_name|escape}" />
			</div>
			{if isset($settings->phone)}
				<a href="tel:{$settings->phone|escape|replace:' ' :''}" class="topphone">{$settings->phone|escape}</a>
			{/if}
		</div>

		<a class="button npk" href="//zoloto-rezerv.ru" target="_blank" style="display: flex; align-items: center; justify-content: center">
			<img src="/design/Zolotomania/images/zoloto-rezerv.png" alt="zoloto-rezerv" style="width: 27px; margin-right: 4px;">
			<span>НПК "Ваш Золотой РезервЪ"</span>
		</a>

		<a class="button au-ag" href="//скупка-золото.рф" target="_blank">
			<span>Скупка Au/Ag</span>
		</a>

		<a id="our_services" class="footer__adress--all button" href="/services" style="margin-bottom: 20px;">Наши сервисы для вас</a>
		<a class="footer__adress--all button" href="/adresa-magazinov">Наши магазины</a>

		<a class="footer__adress--all button" href="/oplata" style="margin-top: 20px;">Оплата</a>
		<a class="footer__adress--all button" href="/policy" style="margin-top: 20px;">Политика конфиденциальности
		</a>

		<div class="row contact-profiles" style="justify-content: center">
				{if $settings->twitter}<div title="Twitter" onclick="window.open('{$settings->twitter|escape}','_blank');" class="twitter"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#231f20"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-.139 9.237c.209 4.617-3.234 9.765-9.33 9.765-1.854 0-3.579-.543-5.032-1.475 1.742.205 3.48-.278 4.86-1.359-1.437-.027-2.649-.976-3.066-2.28.515.098 1.021.069 1.482-.056-1.579-.317-2.668-1.739-2.633-3.26.442.246.949.394 1.486.411-1.461-.977-1.875-2.907-1.016-4.383 1.619 1.986 4.038 3.293 6.766 3.43-.479-2.053 1.08-4.03 3.199-4.03.943 0 1.797.398 2.395 1.037.748-.147 1.451-.42 2.086-.796-.246.767-.766 1.41-1.443 1.816.664-.08 1.297-.256 1.885-.517-.439.656-.996 1.234-1.639 1.697z"/></svg></div>{/if}
				{if $settings->google}<div title="Google+" onclick="window.open('{$settings->google|escape}','_blank');" class="gplus"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#231f20"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-10.333 16.667c-2.581 0-4.667-2.087-4.667-4.667s2.086-4.667 4.667-4.667c1.26 0 2.313.46 3.127 1.22l-1.267 1.22c-.347-.333-.954-.72-1.86-.72-1.593 0-2.893 1.32-2.893 2.947s1.3 2.947 2.893 2.947c1.847 0 2.54-1.327 2.647-2.013h-2.647v-1.6h4.406c.041.233.074.467.074.773-.001 2.666-1.787 4.56-4.48 4.56zm11.333-4h-2v2h-1.334v-2h-2v-1.333h2v-2h1.334v2h2v1.333z"/></svg></div>{/if}
				
				{if $settings->youtube}<div title="Youtube" onclick="window.open('{$settings->youtube|escape}','_blank');" class="youtube"></div>{/if}
				{if $settings->vk}<div title="ВКонтакте" onclick="window.open('{$settings->vk|escape}','_blank');" class="vk">
				{literal}
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.962 511.962" style="enable-background:new 0 0 511.962 511.962;" xml:space="preserve"><g fill="#2787f5"><g><path d="M507.399,370.471c-1.376-2.304-9.888-20.8-50.848-58.816c-42.88-39.808-37.12-33.344,14.528-102.176 c31.456-41.92,44.032-67.52,40.096-78.464c-3.744-10.432-26.88-7.68-26.88-7.68l-76.928,0.448c0,0-5.696-0.768-9.952,1.76 c-4.128,2.496-6.784,8.256-6.784,8.256s-12.192,32.448-28.448,60.032c-34.272,58.208-48,61.28-53.6,57.664 c-13.024-8.416-9.76-33.856-9.76-51.904c0-56.416,8.544-79.936-16.672-86.016c-8.384-2.016-14.528-3.36-35.936-3.584 c-27.456-0.288-50.72,0.096-63.872,6.528c-8.768,4.288-15.52,13.856-11.392,14.4c5.088,0.672,16.608,3.104,22.72,11.424 c7.904,10.72,7.616,34.848,7.616,34.848s4.544,66.4-10.592,74.656c-10.4,5.664-24.64-5.888-55.2-58.72 c-15.648-27.04-27.488-56.96-27.488-56.96s-2.272-5.568-6.336-8.544c-4.928-3.616-11.84-4.768-11.84-4.768l-73.152,0.448 c0,0-10.976,0.32-15.008,5.088c-3.584,4.256-0.288,13.024-0.288,13.024s57.28,133.984,122.112,201.536 c59.488,61.92,127.008,57.856,127.008,57.856h30.592c0,0,9.248-1.024,13.952-6.112c4.352-4.672,4.192-13.44,4.192-13.44 s-0.608-41.056,18.464-47.104c18.784-5.952,42.912,39.68,68.48,57.248c19.328,13.28,34.016,10.368,34.016,10.368l68.384-0.96 C488.583,400.807,524.359,398.599,507.399,370.471z"/></g></g><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/></svg>
					{/literal}
				</div>{/if}
				{if $settings->facebook}<div title="Facebook" onclick="window.open('{$settings->facebook|escape}','_blank');" class="facebook">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 37.51 37.51"><g id="Слой_2" data-name="Слой 2"><g id="Слой_1-2" data-name="Слой 1"><path class="cls-1" fill="#231f20" d="M37.51,6.25A6.48,6.48,0,0,0,31.26,0h-25A6.48,6.48,0,0,0,0,6.25v25a6.48,6.48,0,0,0,6.25,6.25H18.76V23.34H14.17V17.09h4.59V14.65c0-4.2,3.15-8,7-8h5.05v6.25H25.79a1.53,1.53,0,0,0-1.2,1.68v2.49h6.25v6.25H24.59V37.51h6.67a6.47,6.47,0,0,0,6.25-6.25Z"/></g></g></svg>
				</div>{/if}
				{if $settings->insta}<div title="Instagram" onclick="window.open('{$settings->insta|escape}','_blank');" class="insta">
				{literal}
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="30" width="30" viewBox="-19.5036 -32.49725 169.0312 194.9835"><defs><radialGradient fy="578.088" fx="158.429" gradientTransform="matrix(0 -1.98198 1.8439 0 -1031.399 454.004)" gradientUnits="userSpaceOnUse" xlink:href="#a" r="65" cy="578.088" cx="158.429" id="c"/><radialGradient fy="473.455" fx="147.694" gradientTransform="matrix(.17394 .86872 -3.5818 .71718 1648.351 -458.493)" gradientUnits="userSpaceOnUse" xlink:href="#b" r="65" cy="473.455" cx="147.694" id="d"/><linearGradient id="b"><stop stop-color="#3771c8" offset="0"/><stop offset=".128" stop-color="#3771c8"/><stop stop-opacity="0" stop-color="#60f" offset="1"/></linearGradient><linearGradient id="a"><stop stop-color="#fd5" offset="0"/><stop stop-color="#fd5" offset=".1"/><stop stop-color="#ff543e" offset=".5"/><stop stop-color="#c837ab" offset="1"/></linearGradient></defs><path d="M65.033 0C37.891 0 29.953.028 28.41.156c-5.57.463-9.036 1.34-12.812 3.22-2.91 1.445-5.205 3.12-7.47 5.468-4.125 4.282-6.625 9.55-7.53 15.812-.44 3.04-.568 3.66-.594 19.188-.01 5.176 0 11.988 0 21.125 0 27.12.03 35.05.16 36.59.45 5.42 1.3 8.83 3.1 12.56 3.44 7.14 10.01 12.5 17.75 14.5 2.68.69 5.64 1.07 9.44 1.25 1.61.07 18.02.12 34.44.12 16.42 0 32.84-.02 34.41-.1 4.4-.207 6.955-.55 9.78-1.28a27.22 27.22 0 0017.75-14.53c1.765-3.64 2.66-7.18 3.065-12.317.088-1.12.125-18.977.125-36.81 0-17.836-.04-35.66-.128-36.78-.41-5.22-1.305-8.73-3.127-12.44-1.495-3.037-3.155-5.305-5.565-7.624-4.3-4.108-9.56-6.608-15.829-7.512C102.338.157 101.733.027 86.193 0z" fill="url(#c)"/><path d="M65.033 0C37.891 0 29.953.028 28.41.156c-5.57.463-9.036 1.34-12.812 3.22-2.91 1.445-5.205 3.12-7.47 5.468-4.125 4.282-6.625 9.55-7.53 15.812-.44 3.04-.568 3.66-.594 19.188-.01 5.176 0 11.988 0 21.125 0 27.12.03 35.05.16 36.59.45 5.42 1.3 8.83 3.1 12.56 3.44 7.14 10.01 12.5 17.75 14.5 2.68.69 5.64 1.07 9.44 1.25 1.61.07 18.02.12 34.44.12 16.42 0 32.84-.02 34.41-.1 4.4-.207 6.955-.55 9.78-1.28a27.22 27.22 0 0017.75-14.53c1.765-3.64 2.66-7.18 3.065-12.317.088-1.12.125-18.977.125-36.81 0-17.836-.04-35.66-.128-36.78-.41-5.22-1.305-8.73-3.127-12.44-1.495-3.037-3.155-5.305-5.565-7.624-4.3-4.108-9.56-6.608-15.829-7.512C102.338.157 101.733.027 86.193 0z" fill="url(#d)"/><path d="M65.003 17c-13.036 0-14.672.057-19.792.29-5.11.234-8.598 1.043-11.65 2.23-3.157 1.226-5.835 2.866-8.503 5.535-2.67 2.668-4.31 5.346-5.54 8.502-1.19 3.053-2 6.542-2.23 11.65C17.06 50.327 17 51.964 17 65s.058 14.667.29 19.787c.235 5.11 1.044 8.598 2.23 11.65 1.227 3.157 2.867 5.835 5.536 8.503 2.667 2.67 5.345 4.314 8.5 5.54 3.054 1.187 6.543 1.996 11.652 2.23 5.12.233 6.755.29 19.79.29 13.037 0 14.668-.057 19.788-.29 5.11-.234 8.602-1.043 11.656-2.23 3.156-1.226 5.83-2.87 8.497-5.54 2.67-2.668 4.31-5.346 5.54-8.502 1.18-3.053 1.99-6.542 2.23-11.65.23-5.12.29-6.752.29-19.788 0-13.036-.06-14.672-.29-19.792-.24-5.11-1.05-8.598-2.23-11.65-1.23-3.157-2.87-5.835-5.54-8.503-2.67-2.67-5.34-4.31-8.5-5.535-3.06-1.187-6.55-1.996-11.66-2.23-5.12-.233-6.75-.29-19.79-.29zm-4.306 8.65c1.278-.002 2.704 0 4.306 0 12.816 0 14.335.046 19.396.276 4.68.214 7.22.996 8.912 1.653 2.24.87 3.837 1.91 5.516 3.59 1.68 1.68 2.72 3.28 3.592 5.52.657 1.69 1.44 4.23 1.653 8.91.23 5.06.28 6.58.28 19.39s-.05 14.33-.28 19.39c-.214 4.68-.996 7.22-1.653 8.91-.87 2.24-1.912 3.835-3.592 5.514-1.68 1.68-3.275 2.72-5.516 3.59-1.69.66-4.232 1.44-8.912 1.654-5.06.23-6.58.28-19.396.28-12.817 0-14.336-.05-19.396-.28-4.68-.216-7.22-.998-8.913-1.655-2.24-.87-3.84-1.91-5.52-3.59-1.68-1.68-2.72-3.276-3.592-5.517-.657-1.69-1.44-4.23-1.653-8.91-.23-5.06-.276-6.58-.276-19.398s.046-14.33.276-19.39c.214-4.68.996-7.22 1.653-8.912.87-2.24 1.912-3.84 3.592-5.52 1.68-1.68 3.28-2.72 5.52-3.592 1.692-.66 4.233-1.44 8.913-1.655 4.428-.2 6.144-.26 15.09-.27zm29.928 7.97a5.76 5.76 0 105.76 5.758c0-3.18-2.58-5.76-5.76-5.76zm-25.622 6.73c-13.613 0-24.65 11.037-24.65 24.65 0 13.613 11.037 24.645 24.65 24.645C78.616 89.645 89.65 78.613 89.65 65S78.615 40.35 65.002 40.35zm0 8.65c8.836 0 16 7.163 16 16 0 8.836-7.164 16-16 16-8.837 0-16-7.164-16-16 0-8.837 7.163-16 16-16z" fill="#fff"/></svg>
				{/literal}
				</div>{/if}
				{if $settings->viber}<div title="Viber" onclick="window.open('viber:chat?number={$settings->viber}','_blank');"class="viber"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" fill="#231f20"><path d="M19 24h-14c-2.761 0-5-2.239-5-5v-14c0-2.761 2.239-5 5-5h14c2.762 0 5 2.239 5 5v14c0 2.761-2.238 5-5 5zm-.806-17.791c-.419-.386-2.114-1.616-5.887-1.633 0 0-4.451-.268-6.62 1.722-1.207 1.208-1.632 2.974-1.677 5.166-.045 2.192-.103 6.298 3.855 7.411l.004.001-.002 1.699s-.025.688.427.828c.548.17.87-.353 1.393-.916.287-.309.683-.764.982-1.111 2.707.227 4.789-.293 5.026-.37.547-.178 3.639-.574 4.142-4.679.519-4.234-.251-6.911-1.643-8.118zm.458 7.812c-.425 3.428-2.933 3.645-3.395 3.793-.197.063-2.026.518-4.325.368 0 0-1.714 2.067-2.249 2.605-.083.084-.181.118-.247.102-.092-.023-.118-.132-.116-.291l.014-2.824c-3.348-.93-3.153-4.425-3.115-6.255.038-1.83.382-3.33 1.403-4.338 1.835-1.662 5.615-1.414 5.615-1.414 3.192.014 4.722.976 5.077 1.298 1.177 1.008 1.777 3.421 1.338 6.956zm-6.025.206s.3.026.461-.174l.315-.396c.152-.196.519-.322.878-.122.475.268 1.09.69 1.511 1.083.232.196.286.484.128.788l-.002.006c-.162.288-.38.557-.655.807l-.006.005c-.309.258-.665.408-1.046.284l-.007-.01c-.683-.193-2.322-1.029-3.367-1.862-1.709-1.349-2.923-3.573-3.26-4.765l-.01-.007c-.124-.382.027-.738.284-1.046l.005-.006c.251-.275.52-.492.807-.655l.006-.001c.304-.159.592-.105.788.127.258.267.743.908 1.083 1.511.2.359.075.726-.122.878l-.396.315c-.2.161-.174.461-.174.461s.586 2.219 2.779 2.779zm3.451-1.84c.118-.001.213-.097.212-.215-.011-1.404-.441-2.531-1.278-3.348-.835-.814-1.887-1.231-3.126-1.24h-.001c-.117 0-.213.094-.214.212 0 .118.094.214.212.215 1.125.008 2.078.384 2.831 1.119.753.734 1.139 1.759 1.149 3.046.001.117.096.211.213.211h.002zm-1.123-.438h-.005c-.118-.003-.211-.1-.208-.218.016-.73-.192-1.32-.637-1.806-.443-.484-1.051-.749-1.86-.808-.117-.009-.206-.111-.197-.228.009-.118.111-.206.228-.198.91.067 1.631.385 2.144.946.515.562.767 1.27.748 2.103-.002.117-.097.209-.213.209zm-1.095-.367c-.113 0-.207-.089-.213-.203-.036-.724-.377-1.079-1.074-1.116-.117-.007-.208-.107-.201-.225.006-.117.106-.208.224-.201.919.049 1.43.575 1.477 1.521.006.118-.084.218-.202.224h-.011z"/></svg></div>{/if}
				{if $settings->whatsapp}<div title="Whatsapp" onclick="window.open('https:api.whatsapp.com/send?phone={$settings->whatsapp}','_blank');" class="whatsapp"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#231f20"><path d="M12.036 5.339c-3.635 0-6.591 2.956-6.593 6.589-.001 1.483.434 2.594 1.164 3.756l-.666 2.432 2.494-.654c1.117.663 2.184 1.061 3.595 1.061 3.632 0 6.591-2.956 6.592-6.59.003-3.641-2.942-6.593-6.586-6.594zm3.876 9.423c-.165.463-.957.885-1.337.942-.341.051-.773.072-1.248-.078-.288-.091-.657-.213-1.129-.417-1.987-.858-3.285-2.859-3.384-2.991-.099-.132-.809-1.074-.809-2.049 0-.975.512-1.454.693-1.653.182-.2.396-.25.528-.25l.38.007c.122.006.285-.046.446.34.165.397.561 1.372.611 1.471.049.099.083.215.016.347-.066.132-.099.215-.198.33l-.297.347c-.099.099-.202.206-.087.404.116.198.513.847 1.102 1.372.757.675 1.395.884 1.593.983.198.099.314.083.429-.05.116-.132.495-.578.627-.777s.264-.165.446-.099 1.156.545 1.354.645c.198.099.33.149.38.231.049.085.049.482-.116.945zm3.088-14.762h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-6.967 19.862c-1.327 0-2.634-.333-3.792-.965l-4.203 1.103 1.125-4.108c-.694-1.202-1.059-2.566-1.058-3.964.002-4.372 3.558-7.928 7.928-7.928 2.121.001 4.112.827 5.609 2.325s2.321 3.491 2.32 5.609c-.002 4.372-3.559 7.928-7.929 7.928z"/></svg></div>{/if}
				{if $settings->odnoklassniki}<div title="Одноклассники" onclick="window.open('{$settings->odnoklassniki|escape}','_blank');" class="ok">
				{literal}
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="enable-background:new 0 0 64 64;" version="1.1" viewBox="0 0 64 64" xml:space="preserve"><style type="text/css"> .st0{fill:#4267B2;} .st1{fill:url(#SVGID_1_);} .st2{fill:#FFFFFF;} .st3{fill:#C2191E;} .st4{fill:#1DA1F3;} .st5{fill:#FEFE00;} .st6{fill:#25D366;stroke:#FFFFFF;stroke-width:5;stroke-miterlimit:10;} .st7{fill:#CB2027;} .st8{fill:#0077B5;} .st9{fill:url(#SVGID_2_);} .st10{fill:url(#SVGID_3_);} .st11{fill:#FF004F;} .st12{fill:#00F7EF;} .st13{fill:#5181B8;} .st14{fill:#395976;} .st15{fill:#F58220;} .st16{fill:#E6162D;} .st17{fill:#FF9933;} </style><g id="guidlines"/><g id="FB"/><g id="ig"/><g id="yt"/><g id="twitter"/><g id="snapchat"/><g id="WA"/><g id="Pinterrest"/><g id="Layer_9"/><g id="Layer_10"/><g id="Layer_11"><g><g><path class="st15" d="M32,2c-7.4,0-13.5,6-13.5,13.5c0,7.4,6,13.5,13.5,13.5s13.5-6,13.5-13.5C45.5,8,39.4,2,32,2z M32,20 c-2.5,0-4.5-2-4.5-4.5c0-2.5,2-4.5,4.5-4.5c2.5,0,4.5,2,4.5,4.5C36.5,18,34.5,20,32,20z"/></g><g><path class="st15" d="M48.6,38.1c-3.4,1.9-7.1,3.2-10.8,3.8l10.5,12.9c1.2,1.5,1.5,3.6,0.4,5.2c-1.7,2.6-5.3,2.7-7.1,0.4 l-9.7-11.9l-9.6,11.9c-0.9,1.1-2.1,1.6-3.4,1.6c-1.3,0-2.6-0.6-3.5-1.8c-1.1-1.5-1-4,0.2-5.5l10.4-13c-3.7-0.7-7.4-1.9-10.7-3.8 c-2.1-1.2-2.8-3.8-1.6-6c1.2-2.1,3.9-2.8,6-1.6c7.6,4.3,17.1,4.3,24.8,0.1c2.1-1.2,4.8-0.4,5.9,1.7 C51.5,34.3,50.7,36.9,48.6,38.1z"/></g></g></g><g id="Layer_12"/><g id="Layer_13"/><g id="Layer_14"/><g id="Layer_15"/><g id="Layer_16"/><g id="Layer_17"/></svg>
				{/literal}
				</div>{/if}
				{if $settings->telegram}<div title="Telegram" onclick="window.open('{$settings->telegram|escape}','_blank');" class="telegram"><svg width="24px" height="24px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;" fill="#231f20"><path id="telegram-3" d="M19,24l-14,0c-2.761,0 -5,-2.239 -5,-5l0,-14c0,-2.761 2.239,-5 5,-5l14,0c2.762,0 5,2.239 5,5l0,14c0,2.761 -2.238,5 -5,5Zm-2.744,-5.148c0.215,0.153 0.491,0.191 0.738,0.097c0.246,-0.093 0.428,-0.304 0.483,-0.56c0.579,-2.722 1.985,-9.614 2.512,-12.09c0.039,-0.187 -0.027,-0.381 -0.173,-0.506c-0.147,-0.124 -0.351,-0.16 -0.532,-0.093c-2.795,1.034 -11.404,4.264 -14.923,5.567c-0.223,0.082 -0.368,0.297 -0.361,0.533c0.008,0.235 0.167,0.44 0.395,0.509c1.578,0.471 3.65,1.128 3.65,1.128c0,0 0.967,2.924 1.472,4.41c0.063,0.187 0.21,0.334 0.402,0.384c0.193,0.05 0.397,-0.002 0.541,-0.138c0.811,-0.765 2.064,-1.948 2.064,-1.948c0,0 2.381,1.746 3.732,2.707Zm-7.34,-5.784l1.119,3.692l0.249,-2.338c0,0 4.324,-3.9 6.79,-6.124c0.072,-0.065 0.082,-0.174 0.022,-0.251c-0.06,-0.077 -0.169,-0.095 -0.251,-0.043c-2.857,1.825 -7.929,5.064 -7.929,5.064Z"/></svg></div>{/if}
			</div>

		<div class="row footer__bottom" style="flex-direction: column; align-items: center;">
			{$settings->rekvizites}
		</div>
	</footer>


	{if isset($uagent) && $uagent == 'ios' && $module != 'MainView'}
		<a href="javascript:history.go(-1)" class="history_back">&lang;</a>
	{/if}
	{if $module == 'CartView'}
		<script src="androidcore/baloon/js/baloon.js" type="text/javascript"></script>
	{/if}
	<script type="text/javascript" src="androidcore/core2.js?v={filemtime('androidcore/core2.js')}"></script>
	<script>
		$(function() {
			$(".zoom").fancybox({ 'hideOnContentClick' : true });
		});
		// .image_half_width open in modal
		$("img.image-half-width, .image-half-width img").click(function(){
			$.fancybox({ 'href' : $(this).attr('src') , 'hideOnContentClick' : true });
		})
	</script>

	{if $module == 'MainView'}
		<script src="/androidcore/slider.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(window).load(function() { 
				var element = document.getElementById('slider');
				window.mySwipe = new Swipe(element, {
				  startSlide: 0,
				  auto: 5000,
				  draggable: true,
				  autoRestart: true,
				  continuous: true,
				  disableScroll: false,
				  stopPropagation: false,
				  callback: function(index, element) { $('.dot').removeClass('active');$('#'+index).addClass('active'); },
				  transitionEnd: function(index, element) {}
				});
			});
		</script>
		<script type="text/javascript">
			// убирание под кат
			heightt=$('.top .cutinner').height();	
			if(heightt<{$settings->cutmob}){
				$('.top.cutouter').addClass('fullheight');
				$('.top .disappear').hide();
			} else {
				$('.top.cutmore').show();
			}
			$('.cutmore').click(function() { 
				$(this).toggleText('Развернуть...', 'Свернуть...');
				$(this).prev().toggleClass('fullheight');
				$(this).prev().find('.disappear').toggle();
				if ($(this).prev().find('.disappear').is(':visible')) {
					destination = $(this).prev().offset().top;
					$('html, body').animate( { scrollTop: destination }, 0 );
				}
			});
			// убирание под кат end
		</script>
	{/if}

	{if in_array($module, array('BlogView', 'FeedbackView', 'LoginView', 'RegisterView', 'UserView', 'ProductView'))}
		<script defer src="androidcore/baloon/js/baloon.js" type="text/javascript"></script>
	{/if}

	{if $module == 'ProductsView'}
		{*<script type="text/javascript" src="androidcore/lazyload.js"></script>
		<script>
			{literal}
				$(document).ready(function () {
					$(window).load(function() {$('img.lazy').lazyload();});
				});
			{/literal}
		</script>*}

		<script src="androidcore/priceslider.js" type="text/javascript"></script>
		{if !empty($keyword) || (!empty($category->brands) && $category->brands|count>1) || !empty($features) || (isset($minCost) && isset($maxCost) && $minCost<$maxCost)}
			{* <div class="hidefeaturesbtn" onclick="hideFeatures(this);return false;">
				<svg viewBox="0 0 24 24">
    				<path d="M3,2H21V2H21V4H20.92L14,10.92V22.91L10,18.91V10.91L3.09,4H3V2Z" />
				</svg>
			</div> *}
		{/if}
		<script type="text/javascript">
			// cfeatures
			function hideFeatures(el){
				$('.hidefeaturesbtn').toggleClass('show');
				$('#features').toggleClass('show');
				$('html').removeClass('fullheight');
				$('.page-pg, .category_products, #start, .ajax_pagination').show();

				if ($(".hidefeaturesbtn").is('.show')) {
					$('html').addClass('fullheight');
					$('.page-pg, .category_products, #start, .ajax_pagination').hide();
				}
				return false;
			};		
			// убирание под кат
			heightb=$('.bottom .cutinner').height();	
			if(heightb<{$settings->cutmob}){
				$('.bottom.cutouter').addClass('fullheight');
				$('.bottom .disappear').hide();
			} else {
				$('.bottom.cutmore').show();
			}
			heightt=$('.top .cutinner').height();	
			if(heightt<{$settings->cutmob}){
				$('.top.cutouter').addClass('fullheight');
			} else {
				$('.top.cutmore').show();
				$('.top .disappear').show();
			}
			$(document).on('click', '.cutmore', function () { 
				$(this).toggleText('Развернуть...', 'Свернуть...');
				$(this).prev().toggleClass('fullheight');
				$(this).prev().find('.disappear').toggle();
				if ($(this).prev().find('.disappear').is(':visible')) {
					destination = $(this).prev().offset().top;
					$('html, body').animate( { scrollTop: destination }, 0 );
				}
			});
			// убирание под кат end
		</script>
	{/if}
	
	{if in_array($module, array('ProductsView', 'ArticlesView', 'BlogView', 'SurveysView')) && !empty($total_pages_num) && $total_pages_num > 1 }
		{* infinite ajax pagination *}
			<script type="text/javascript">
				$('.infinite_prev').show();
				var offset = 800; // start next page
				var scroll_timeout = 100; // window scroll throttle setTimeout
				{if $module == 'ProductsView'}var update_products = 1;{/if}
			</script>
			<script type="text/javascript" src="androidcore/infinite_ajax.js"></script>
		{* infinite ajax pagination end *}
	{/if}
	
	{if $module == 'ProductView'}
		<script type="text/javascript" src="androidcore/product.js"></script>
		<script src="js/rating/project.js"></script>
		<script type="text/javascript">
			$(function() { 
				$('.testRater').rater({ postHref: 'ajax/rating.php' }); 
			});
		</script>
		<script>
		// Amount change
		$(window).load(function() {
			stock=parseInt($('select[name=variant]').find('option:selected').attr('v_stock'));
			if( !$.isNumeric(stock) ){ stock = {$settings->max_order_amount|escape}; }
			$('.variants .amount').attr('data-max',stock);
		});
		$('select[name=variant]').change(function(){
			stock=parseInt($(this).find('option:selected').attr('v_stock'));
			if( !$.isNumeric(stock) ) 
				stock = {$settings->max_order_amount|escape};
			$('.variants .amount').attr('data-max',stock);
			oldamount = parseInt($('.variants .amount').val());
			if(oldamount > stock) 
				$('.variants .amount').val(stock);
		});

		$(document).ready(function() { 
			$('.minus').click(function () { 
				var $input = $(this).parent().find('.amount');
		
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				if( !$.isNumeric(count) ){ count = 1; }
		
				maxamount = parseInt($('#amount .amount').attr('data-max'));
				if( !$.isNumeric(maxamount) ){ maxamount = {$settings->max_order_amount|escape}; $('#amount .amount').attr('data-max',maxamount);}
				if(count < maxamount)
					$input.val(count);
				else
					$input.val(maxamount);
		
				$input.change();
				return false;
			});
			$('.plus').click(function () { 
				var $input = $(this).parent().find('.amount');
				oldamount = parseInt($input.val());
				if( !$.isNumeric(oldamount) ){ oldamount = 1; }
		
				maxamount = parseInt($('#amount .amount').attr('data-max'));
				if( !$.isNumeric(maxamount) ){ maxamount = {$settings->max_order_amount|escape}; $('#amount .amount').attr('data-max',maxamount);}
		
				if(oldamount < maxamount)
					$input.val(oldamount + 1);
				else
					$input.val(maxamount);
				$input.change();
				return false;
			});
		});
		</script>
		<script>
			$(function() {
				$(".various").fancybox({
					'hideOnContentClick' : false,
					'hideOnOverlayClick' : false,
					'onComplete': function() { $('body').css('overflow','hidden');},
					'onClosed': function() { $('body').css('overflow','visible');}
                });
			});
		</script>
		<script defer type="text/javascript" src="js/superembed.min.js"></script>
		<script type="text/javascript">$('#tab1 iframe').addClass('superembed-force')</script>
	{/if}
	
	{if in_array($module, array('ArticlesView', 'BlogView', 'ServicesView')) && (!empty($post->images) || !empty($service->images))}
		{*<script src="js/swipebox/ios-orientationchange-fix.js"></script>*}
		<script src="js/swipebox/jquery.swipebox.min.js"></script>
		<link type="text/css" rel="stylesheet" href="js/swipebox/swipebox.css"/>
		<script>
		$(function() { 
			$(".swipebox").swipebox({ hideBarsDelay : 0 });
		});
		</script>
	{/if}

	<div class="mainloader" style="display:none;">
	    <div class="loaderspinner">
			<div class="cssload-loader">
				<div class="cssload-inner cssload-one"></div>
				<div class="cssload-inner cssload-two"></div>
				<div class="cssload-inner cssload-three"></div>
			</div>
	    </div>	
	</div>
	
	{* user forms *}
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
							<input name="f-subject" placeholder="Форма" type="hidden" value="{$form->name|escape}" />
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
	{* user forms end *}	

	{* Поддержка свайпа *}
	<script src="design/mobile/js/custom.js" type="text/javascript"></script>
	{if !empty($mobile_app)}
		{* Android *}
		{*<script type="text/javascript">
				try { 
					Phone.sendPhone("+7 (123) 4567-891");
				} catch(e) {};
		</script>*}
		<script type="text/javascript">
			try { 
				Search.sendSearch("{if $module == 'BlogView'}blog{elseif $module == 'ArticlesView'}articles{elseif $module == 'ServicesView'}services{else}{if $settings->purpose == 0}products{elseif $settings->purpose == 1}services{/if}{/if}");
			} catch(e) {};
		</script>
		{* Android @ *}
		{* Android & iOS *}
		<div id="cart_informer" style="display:none;">
			{include file='cart_informer.tpl'}
		</div>
		{* Android & iOS @*}
		{* iOS *}
		<script>
			try { 
				{*window.webkit.messageHandlers.phone.postMessage("{if $settings->phone}{$settings->phone|escape}{elseif $settings->tel}{$settings->tel|escape}{/if}");*}
				window.webkit.messageHandlers.search.postMessage("{if $module == 'BlogView'}blog{elseif $module == 'ArticlesView'}articles{elseif $module == 'ServicesView'}services{elseif $settings->purpose == 0}products{elseif $settings->purpose == 1}services{/if}");
			} catch(e) {};
		</script>
		{* iOS @ *}
	{else}
		<script>
			$(window).load(function() { 
			var swipem = new MobiSwipe("body");
			swipem.direction = swipem.HORIZONTAL;
			swipem.onswipeleft = function() {
				if ( $('#catalog').hasClass('showcat') ) {
					hideShowOverlay(this);
				}
				return!1};
			});
		</script>
	{/if}
	{*{if $uagent == 'ios'}
	<script>
		// Загружаем пред. страницу
		$(window).load(function() { 
			var swipem = new MobiSwipe("body");
			swipem.direction = swipem.HORIZONTAL;
			swipem.AXIS_THRESHOLD = 20; // угол отклонения
			swipem.GESTURE_DELTA = 100; // сдвиг до срабатывания
			swipem.onswiperight = function() {
				window.history.back();
				return!1};
		});
	</script>
	{/if}*}
	
	<div style="display:none;">
		{if $settings->counters}
			<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){ m[i]=m[i]||function(){ (m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym({$settings->counters}, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, ecommerce:"dataLayer" }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/{$settings->counters}" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
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
	<script type="text/javascript">
	{literal}
		document.addEventListener('touchstart', function(e) {
			document.addEventListener('touchend', function(e) {
			});
		});
		$(function() {
			$("img, .pagination a, .category_products .product, a, .button, button").click(function() {
				$(this).addClass("active");
			})
		});
		$(document).ready(function () {
			$(window).load(function() { 
				$('a').removeAttr('target'); 
			});
		});
	{/literal}
	</script>
	
	{* svg sprite *}
	<svg style="display:none;">
		<symbol id="arrow_left" viewBox="0 0 60.75 51.33">
			<g id="Слой_2" data-name="Слой 2"><g id="Слой_1-2" data-name="Слой 1"><line class="cls-1" fill="none" stroke="#414042" stroke-linecap="round" stroke-linejoin="round" stroke-width="5px" x1="4.82" y1="25.66" x2="58.25" y2="25.66"/><polyline class="cls-1" fill="none" stroke="#414042" stroke-linecap="round" stroke-linejoin="round" stroke-width="5px" points="33.83 48.83 2.5 25.66 33.83 2.5"/></g></g>
		</symbol>
		<symbol id="arrow_tool" viewBox="0 0 24 24">
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
		<symbol id="folder" viewBox="0 0 24 24">
			<path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"/><path d="M0 0h24v24H0z" fill="none"/>
		</symbol>
		<symbol id="hit" viewBox="0 0 24 24">
			<path d="M16.23,18L12,15.45L7.77,18L8.89,13.19L5.16,9.96L10.08,9.54L12,5L13.92,9.53L18.84,9.95L15.11,13.18L16.23,18M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
		</symbol>
		<symbol id="new" viewBox="0 0 24 24">
			<path d="M20,4C21.11,4 22,4.89 22,6V18C22,19.11 21.11,20 20,20H4C2.89,20 2,19.11 2,18V6C2,4.89 2.89,4 4,4H20M8.5,15V9H7.25V12.5L4.75,9H3.5V15H4.75V11.5L7.3,15H8.5M13.5,10.26V9H9.5V15H13.5V13.75H11V12.64H13.5V11.38H11V10.26H13.5M20.5,14V9H19.25V13.5H18.13V10H16.88V13.5H15.75V9H14.5V14A1,1 0 0,0 15.5,15H19.5A1,1 0 0,0 20.5,14Z" />
		</symbol>
		<symbol id="lowprice" viewBox="0 0 24 24">
			<path d="M18.65,2.85L19.26,6.71L22.77,8.5L21,12L22.78,15.5L19.24,17.29L18.63,21.15L14.74,20.54L11.97,23.3L9.19,20.5L5.33,21.14L4.71,17.25L1.22,15.47L3,11.97L1.23,8.5L4.74,6.69L5.35,2.86L9.22,3.5L12,0.69L14.77,3.46L18.65,2.85M9.5,7A1.5,1.5 0 0,0 8,8.5A1.5,1.5 0 0,0 9.5,10A1.5,1.5 0 0,0 11,8.5A1.5,1.5 0 0,0 9.5,7M14.5,14A1.5,1.5 0 0,0 13,15.5A1.5,1.5 0 0,0 14.5,17A1.5,1.5 0 0,0 16,15.5A1.5,1.5 0 0,0 14.5,14M8.41,17L17,8.41L15.59,7L7,15.59L8.41,17Z" />
		</symbol>
		<symbol id="brands" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path opacity=".3" d="M12 11h2v2h-2v2h2v2h-2v2h8V9h-8v2zm4 0h2v2h-2v-2zm0 4h2v2h-2v-2z"/><path d="M16 15h2v2h-2zm0-4h2v2h-2zm6-4H12V3H2v18h20V7zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10z"/>
		</symbol>
		{if in_array($module, array('BlogView', 'ArticlesView', 'TagsView', 'MainView'))}
		<symbol id="calendar" viewBox="0 0 24 24">
			<path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
			<path d="M0 0h24v24H0z" fill="none"/>
		</symbol>
		<symbol id="views" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M16.24 7.75c-1.17-1.17-2.7-1.76-4.24-1.76v6l-4.24 4.24c2.34 2.34 6.14 2.34 8.49 0 2.34-2.34 2.34-6.14-.01-8.48zM12 1.99c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/>
		</symbol>
		<symbol id="comments_count" viewBox="0 0 24 24">
			<path d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z" />
		</symbol>
		{/if}
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
	
	{* Ссылка на моб. приложение
	{if empty($mobile_app) && empty($smarty.cookies.appadv)}
		{include file='installapp.tpl'}
	{/if} *}

	{if !empty($settings->script_footer)}{$settings->script_footer}{/if}
	
	{* OnlineChat *}
	{if !empty($settings->consultant)}
		<script id="rhlpscrtg" type="text/javascript" charset="utf-8" async="async" 
			src="https://web.redhelper.ru/service/main.js?c={$settings->consultant|escape}">
		</script> 
	{/if}
	{* OnlineChat end *}
	
</body>
</html>
