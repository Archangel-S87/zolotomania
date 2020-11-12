<?php
/* Smarty version 3.1.33, created on 2020-11-12 16:25:30
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fad61fa8f6024_54415377',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8fdf498133236f7aaf42c21b2442045d457e23a7' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/index.tpl',
      1 => 1605198327,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:toolbar.tpl' => 1,
    'file:cfeatures.tpl' => 1,
    'file:conf.tpl' => 1,
    'file:antibot.tpl' => 1,
    'file:cart_informer.tpl' => 1,
  ),
),false)) {
function content_5fad61fa8f6024_54415377 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html> <html dir="ltr" lang="ru" prefix="og: http://ogp.me/ns#"> <head> <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/> <base href="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/"/>
	<?php if ($_smarty_tpl->tpl_vars['module']->value == "ProductView") {?>
					<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->name)) {
$_smarty_tpl->_assignInScope('ctg', (" | ").($_smarty_tpl->tpl_vars['category']->value->name));
} else {
$_smarty_tpl->_assignInScope('ctg', '');
}?>
			<?php if (!empty($_smarty_tpl->tpl_vars['brand']->value->name)) {
$_smarty_tpl->_assignInScope('brnd', (" | ").($_smarty_tpl->tpl_vars['brand']->value->name));
} else {
$_smarty_tpl->_assignInScope('brnd', '');
}?>
			<?php if (empty($_smarty_tpl->tpl_vars['meta_title']->value) && !empty($_smarty_tpl->tpl_vars['product']->value->name)) {?>
				<?php $_smarty_tpl->_assignInScope('seo_title', (($_smarty_tpl->tpl_vars['product']->value->name).($_smarty_tpl->tpl_vars['ctg']->value)).($_smarty_tpl->tpl_vars['brnd']->value));?>
			<?php }?>
					<?php $_smarty_tpl->_assignInScope('first_category', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'first' ][ 0 ], array( $_smarty_tpl->tpl_vars['category']->value->path )));?>
			<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->seo_one)) {?>
				<?php $_smarty_tpl->_assignInScope('seo_one', $_smarty_tpl->tpl_vars['category']->value->seo_one);?>
			<?php } elseif (!empty($_smarty_tpl->tpl_vars['first_category']->value->seo_one)) {?>
				<?php $_smarty_tpl->_assignInScope('seo_one', $_smarty_tpl->tpl_vars['first_category']->value->seo_one);?>
			<?php } else { ?>
				<?php $_smarty_tpl->_assignInScope('seo_one', '');?>
			<?php }?>
			<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->seo_two)) {?>
				<?php $_smarty_tpl->_assignInScope('seo_two', $_smarty_tpl->tpl_vars['category']->value->seo_two);?>
			<?php } elseif (!empty($_smarty_tpl->tpl_vars['first_category']->value->seo_two)) {?>
				<?php $_smarty_tpl->_assignInScope('seo_two', $_smarty_tpl->tpl_vars['first_category']->value->seo_two);?>
			<?php } else { ?>
				<?php $_smarty_tpl->_assignInScope('seo_two', '');?>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['category']->value->seo_type == 1 && !empty($_smarty_tpl->tpl_vars['product']->value->variant->price)) {?>
				<?php $_smarty_tpl->_assignInScope('seo_description', (((((($_smarty_tpl->tpl_vars['seo_one']->value).($_smarty_tpl->tpl_vars['product']->value->name)).(" ✩ за ")).((preg_replace('!\s+!u', '',call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value->variant->price )))))).(" ")).($_smarty_tpl->tpl_vars['currency']->value->sign)).($_smarty_tpl->tpl_vars['seo_two']->value));?>
			<?php } else { ?>
				<?php $_smarty_tpl->_assignInScope('seo_description', (($_smarty_tpl->tpl_vars['seo_one']->value).($_smarty_tpl->tpl_vars['product']->value->name)).($_smarty_tpl->tpl_vars['seo_two']->value));?>
			<?php }?>
	<?php } else { ?>
				<?php if (!empty($_smarty_tpl->tpl_vars['meta_title']->value)) {?>
			<?php $_smarty_tpl->_assignInScope('seo_description', (((($_smarty_tpl->tpl_vars['meta_title']->value).($_smarty_tpl->tpl_vars['settings']->value->seo_description)).(" ✩ ")).($_smarty_tpl->tpl_vars['settings']->value->site_name)).(" ✩"));?>
		<?php } elseif (!empty($_smarty_tpl->tpl_vars['page']->value->header)) {?>
			<?php $_smarty_tpl->_assignInScope('seo_description', (((($_smarty_tpl->tpl_vars['page']->value->header).($_smarty_tpl->tpl_vars['settings']->value->seo_description)).(" ✩ ")).($_smarty_tpl->tpl_vars['settings']->value->site_name)).(" ✩"));?>
		<?php }?>
	<?php }?>
	<title><?php if (!empty($_smarty_tpl->tpl_vars['meta_title']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true);
} elseif (!empty($_smarty_tpl->tpl_vars['seo_title']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['seo_title']->value, ENT_QUOTES, 'UTF-8', true);
}
if (!empty($_smarty_tpl->tpl_vars['current_page_num']->value) && $_smarty_tpl->tpl_vars['current_page_num']->value > 1) {?> - страница <?php echo $_smarty_tpl->tpl_vars['current_page_num']->value;
}?></title> <meta name="description" content="<?php if (!empty($_smarty_tpl->tpl_vars['meta_description']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_description']->value, ENT_QUOTES, 'UTF-8', true);
} elseif (!empty($_smarty_tpl->tpl_vars['seo_description']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['seo_description']->value, ENT_QUOTES, 'UTF-8', true);
}?>" /> <meta name="keywords" content="<?php if (!empty($_smarty_tpl->tpl_vars['meta_keywords']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_keywords']->value, ENT_QUOTES, 'UTF-8', true);
}?>" /> <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=yes"/> <meta http-equiv="X-UA-Compatible" content="IE=edge"/> <!--canonical--><?php if (isset($_smarty_tpl->tpl_vars['canonical']->value)) {?><link rel="canonical" href="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;
echo $_smarty_tpl->tpl_vars['canonical']->value;?>
"/><?php }?><!--/canonical-->
	<?php if (!empty($_smarty_tpl->tpl_vars['current_page_num']->value) && $_smarty_tpl->tpl_vars['current_page_num']->value == 2) {?><link rel="prev" href="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>null),$_smarty_tpl ) );?>
"><?php }?>
	<?php if (!empty($_smarty_tpl->tpl_vars['current_page_num']->value) && $_smarty_tpl->tpl_vars['current_page_num']->value > 2) {?><link rel="prev" href="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['current_page_num']->value-1),$_smarty_tpl ) );?>
"><?php }?>
	<?php if (!empty($_smarty_tpl->tpl_vars['current_page_num']->value) && $_smarty_tpl->tpl_vars['current_page_num']->value < $_smarty_tpl->tpl_vars['total_pages_num']->value) {?><link rel="next" href="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['current_page_num']->value+1),$_smarty_tpl ) );?>
"><?php }?>
	<?php if (!empty($_smarty_tpl->tpl_vars['current_page_num']->value) && $_smarty_tpl->tpl_vars['current_page_num']->value > 1) {?><meta name=robots content="index,follow"><?php }?>
	
	<meta name="theme-color" content="#<?php echo $_smarty_tpl->tpl_vars['mobtheme']->value->colorPrimaryDark;?>
"/> <style>
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
		<link rel="stylesheet" type="text/css" href="design/mobile_mod/css/style.css?v=<?php echo filemtime('design/mobile_mod/css/style.css');?>
"/>
	<?php if ($_smarty_tpl->tpl_vars['module']->value == 'SurveysView') {?>
		<link rel="stylesheet" type="text/css" href="design/mobile_mod/css/survey.css?v=<?php echo filemtime("design/mobile_mod/css/survey.css");?>
"/>
	<?php }?>
	<link href="favicon.ico" rel="icon" type="image/x-icon"/> <link href="favicon.ico" rel="shortcut icon" type="image/x-icon"/> <link href="favicon.ico" rel="apple-touch-icon"> <meta name="format-detection" content="telephone=no">
	
		<?php if ($_smarty_tpl->tpl_vars['module']->value == 'ProductView') {?>
		<meta name="twitter:url" property="og:url" content="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;
echo $_SERVER['REQUEST_URI'];?>
"> <meta property="og:type" content="website"> <meta name="twitter:card" content="product"/> <meta name="twitter:title" property="og:title" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->name, ENT_QUOTES, 'UTF-8', true);?>
"> <meta name="twitter:description" property="og:description" content='<?php if (!empty($_smarty_tpl->tpl_vars['product']->value->annotation)) {
echo htmlspecialchars(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['product']->value->annotation), ENT_QUOTES, 'UTF-8', true);
} elseif (!empty($_smarty_tpl->tpl_vars['meta_description']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_description']->value, ENT_QUOTES, 'UTF-8', true);
}?>'>
		<?php if (!empty($_smarty_tpl->tpl_vars['product']->value->image->filename)) {?>
			<meta name="twitter:image" property="og:image" content="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'resize' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value->image->filename,800,600,'w' ));?>
"> <link rel="image_src" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'resize' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value->image->filename,800,600,'w' ));?>
">
		<?php } else { ?>
			<meta name="twitter:image" property="og:image" content="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/js/nophoto.png"> <link rel="image_src" href="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/js/nophoto.png">
		<?php }?>
		<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->site_name)) {?>
			<meta name="twitter:site" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->site_name, ENT_QUOTES, 'UTF-8', true);?>
">
		<?php }?>
		<?php if (!empty($_smarty_tpl->tpl_vars['product']->value->variant->price)) {?>
			<meta name="twitter:data1" content="Цена"> <meta name="twitter:label1" content="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'convert' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value->variant->price ));?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->code, ENT_QUOTES, 'UTF-8', true);?>
">
		<?php }?>
		<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->company_name)) {?>
			<meta name="twitter:data2" content="Организация"> <meta name="twitter:label2" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->company_name, ENT_QUOTES, 'UTF-8', true);?>
">
		<?php }?>
	<?php } elseif (in_array($_smarty_tpl->tpl_vars['module']->value,array('BlogView','ArticlesView','SurveysView'))) {?>
		<meta property="og:url" content="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;
echo $_SERVER['REQUEST_URI'];?>
"> <meta property="og:type" content="article"> <meta name="twitter:card" content="summary"> <meta name="twitter:title" property="og:title" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true);?>
">
		<?php if (!empty($_smarty_tpl->tpl_vars['post']->value->image)) {?>
			<meta name="twitter:image" property="og:image" content="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'resize' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value->image->filename,400,400 ));?>
"> <link rel="image_src" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'resize' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value->image->filename,400,400 ));?>
">
		<?php } elseif (!empty($_smarty_tpl->tpl_vars['post']->value->images[1])) {?>
			<meta name="twitter:image" property="og:image" content="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'resize' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value->images[1]->filename,800,600,'w' ));?>
"> <link rel="image_src" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'resize' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value->images[1]->filename,800,600,'w' ));?>
">	
		<?php } else { ?>
			<meta name="twitter:image" property="og:image" content="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/files/logo/logo.png"> <link rel="image_src" href="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/files/logo/logo.png">
		<?php }?>
		<meta name="twitter:description" property="og:description" content="<?php if (!empty($_smarty_tpl->tpl_vars['post']->value->annotation)) {
echo htmlspecialchars(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['post']->value->annotation), ENT_QUOTES, 'UTF-8', true);
} elseif (!empty($_smarty_tpl->tpl_vars['meta_description']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_description']->value, ENT_QUOTES, 'UTF-8', true);
}?>">
	<?php } else { ?>
		<meta name="twitter:title" property="og:title" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true);?>
"> <meta property="og:type" content="website"> <meta name="twitter:card" content="summary"> <meta property="og:url" content="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;
echo $_SERVER['REQUEST_URI'];?>
"> <meta name="twitter:image" property="og:image" content="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/files/logo/logo.png"> <link rel="image_src" href="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/files/logo/logo.png"> <meta property="og:site_name" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->site_name, ENT_QUOTES, 'UTF-8', true);?>
">
		<?php if (!empty($_smarty_tpl->tpl_vars['meta_description']->value)) {?><meta name="twitter:description" property="og:description" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_description']->value, ENT_QUOTES, 'UTF-8', true);?>
"><?php }?>
	<?php }?>
		<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->script_header)) {
echo $_smarty_tpl->tpl_vars['settings']->value->script_header;
}?>
	<?php echo '<script'; ?>
 src="js/jquery/jquery-1.12.4.min.js"><?php echo '</script'; ?>
>
	<?php if ($_smarty_tpl->tpl_vars['settings']->value->analytics) {?>
		<!-- Global site tag (gtag.js) - Google Analytics --> <?php echo '<script'; ?>
 async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $_smarty_tpl->tpl_vars['settings']->value->analytics;?>
"><?php echo '</script'; ?>
> <?php echo '<script'; ?>
>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){ dataLayer.push(arguments);}
		  gtag('js', new Date());
		  gtag('config', '<?php echo $_smarty_tpl->tpl_vars['settings']->value->analytics;?>
');
		<?php echo '</script'; ?>
>
	<?php }?>
</head> <body id="body" <?php if (in_array($_smarty_tpl->tpl_vars['module']->value,array('MainView','ProductsView','WishlistView')) || (!empty($_smarty_tpl->tpl_vars['page']->value->url) && $_smarty_tpl->tpl_vars['page']->value->url == 'catalog')) {?>class="nonwhitebg"<?php }?>>

	<?php if (empty($_smarty_tpl->tpl_vars['mobile_app']->value)) {?>
		<?php $_smarty_tpl->_subTemplateRender('file:toolbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['module']->value != 'MainView') {?>
	
		<div class="breadcrumb">
			<?php if ($_smarty_tpl->tpl_vars['module']->value == 'ProductsView') {?>
				<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->name)) {?>
					<?php if (empty($_smarty_tpl->tpl_vars['category']->value->subcategories)) {?>
												<a href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60.75 51.33"><g id="Слой_2" data-name="Слой 2"><g id="Слой_1-2" data-name="Слой 1"><line class="cls-1" fill="none" stroke="#414042" stroke-linecap="round" stroke-linejoin="round" stroke-width="5px" x1="4.82" y1="25.66" x2="58.25" y2="25.66"/><polyline class="cls-1" fill="none" stroke="#414042" stroke-linecap="round" stroke-linejoin="round" stroke-width="5px" points="33.83 48.83 2.5 25.66 33.83 2.5"/></g></g></svg></a>
					<?php }?>
				<?php }?> 
			<?php }?> 
			<h1 id="uphere" <?php if ($_smarty_tpl->tpl_vars['module']->value == 'SurveysView' && empty($_smarty_tpl->tpl_vars['user']->value->id)) {?>blured<?php }?>"> <!--h1-->
				<?php if (!empty($_smarty_tpl->tpl_vars['h1_title']->value)) {?>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['h1_title']->value, ENT_QUOTES, 'UTF-8', true);?>

				<?php } else { ?>
					<?php if (!empty($_smarty_tpl->tpl_vars['keyword']->value)) {?>Поиск по "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['keyword']->value, ENT_QUOTES, 'UTF-8', true);?>
"
					<?php } elseif (!empty($_smarty_tpl->tpl_vars['page']->value->header)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value->header, ENT_QUOTES, 'UTF-8', true);?>

					<?php } elseif (!empty($_smarty_tpl->tpl_vars['page_name']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['page_name']->value, ENT_QUOTES, 'UTF-8', true);?>

					<?php } elseif (!empty($_smarty_tpl->tpl_vars['page']->value->name)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value->name, ENT_QUOTES, 'UTF-8', true);?>

					<?php } else { ?>
						<?php if (in_array($_smarty_tpl->tpl_vars['module']->value,array('BlogView','ArticlesView','ServicesView'))) {?>
							<?php if (!empty($_smarty_tpl->tpl_vars['post']->value->name)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->name, ENT_QUOTES, 'UTF-8', true);?>

							<?php } elseif (!empty($_smarty_tpl->tpl_vars['category']->value->name)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);?>

							<?php }?>
						<?php } elseif ($_smarty_tpl->tpl_vars['module']->value == 'SurveysView') {?>
							<?php if (!empty($_smarty_tpl->tpl_vars['survey']->value->name)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['survey']->value->name, ENT_QUOTES, 'UTF-8', true);?>

							<?php } elseif (!empty($_smarty_tpl->tpl_vars['category']->value->name)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);?>

							<?php }?>
						<?php } elseif ($_smarty_tpl->tpl_vars['module']->value == 'ProductsView') {?>
							<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->name)) {?>						
								<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);?>

							<?php }?> 
							<?php if (!empty($_smarty_tpl->tpl_vars['brand']->value->name)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['brand']->value->name, ENT_QUOTES, 'UTF-8', true);
}?> 
						<?php } elseif ($_smarty_tpl->tpl_vars['module']->value == 'ProductView') {?>
																			<?php }?>
					<?php }?>
				<?php }?>
				<!--/h1--> </h1>
			<?php if ($_smarty_tpl->tpl_vars['module']->value == 'ProductsView') {?>
				<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->name)) {?>
					<?php if (empty($_smarty_tpl->tpl_vars['category']->value->subcategories)) {?>
						<?php $_smarty_tpl->_subTemplateRender('file:cfeatures.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
					<?php }?>
				<?php }?> 
			<?php } elseif ($_smarty_tpl->tpl_vars['module']->value == 'ProductView') {?>
								<a href="#" style="margin: 0 0 0 auto"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60.75 51.33"><g id="Слой_2" data-name="Слой 2"><g id="Слой_1-2" data-name="Слой 1"><line class="cls-1" fill="none" stroke="#414042" stroke-linecap="round" stroke-linejoin="round" stroke-width="5px" x1="4.82" y1="25.66" x2="58.25" y2="25.66"/><polyline class="cls-1" fill="none" stroke="#414042" stroke-linecap="round" stroke-linejoin="round" stroke-width="5px" points="33.83 48.83 2.5 25.66 33.83 2.5"/></g></g></svg></a>
			<?php }?> 
		</div>
	<?php }?>

	<div id="container" <?php if ($_smarty_tpl->tpl_vars['module']->value == 'SurveysView' && empty($_smarty_tpl->tpl_vars['user']->value->id)) {?>class="blured"<?php }?>> <div id="content" <?php if ($_smarty_tpl->tpl_vars['module']->value) {?>class="<?php echo mb_strtolower($_smarty_tpl->tpl_vars['module']->value, 'UTF-8');?>
"<?php }?>>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		</div> </div>
		<footer> <div class="row"> <div id="logo"> <img onclick="window.location='/'" src="files/logo/logo.png?v=<?php echo filemtime('files/logo/logo.png');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->site_name, ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->site_name, ENT_QUOTES, 'UTF-8', true);?>
" /> </div>
						<a href="tel:8800123-45-67" class="topphone">8 (800) 123-45-67</a> </div> <nav>
					<ul> <li><a href="#">Акции</a></li> <li><a href="#">Ювелирные изделия</a></li> <li><a href="#">Коллекции</a></li> <li><a href="#">Бренды</a></li> <li><a href="#">Подарки</a></li> </ul> </nav> <div class="contact-profiles">
				<?php if ($_smarty_tpl->tpl_vars['settings']->value->twitter) {?><div title="Twitter" onclick="window.open('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->twitter, ENT_QUOTES, 'UTF-8', true);?>
','_blank');" class="twitter"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#231f20"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-.139 9.237c.209 4.617-3.234 9.765-9.33 9.765-1.854 0-3.579-.543-5.032-1.475 1.742.205 3.48-.278 4.86-1.359-1.437-.027-2.649-.976-3.066-2.28.515.098 1.021.069 1.482-.056-1.579-.317-2.668-1.739-2.633-3.26.442.246.949.394 1.486.411-1.461-.977-1.875-2.907-1.016-4.383 1.619 1.986 4.038 3.293 6.766 3.43-.479-2.053 1.08-4.03 3.199-4.03.943 0 1.797.398 2.395 1.037.748-.147 1.451-.42 2.086-.796-.246.767-.766 1.41-1.443 1.816.664-.08 1.297-.256 1.885-.517-.439.656-.996 1.234-1.639 1.697z"/></svg></div><?php }?>
				<?php if ($_smarty_tpl->tpl_vars['settings']->value->google) {?><div title="Google+" onclick="window.open('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->google, ENT_QUOTES, 'UTF-8', true);?>
','_blank');" class="gplus"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#231f20"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-10.333 16.667c-2.581 0-4.667-2.087-4.667-4.667s2.086-4.667 4.667-4.667c1.26 0 2.313.46 3.127 1.22l-1.267 1.22c-.347-.333-.954-.72-1.86-.72-1.593 0-2.893 1.32-2.893 2.947s1.3 2.947 2.893 2.947c1.847 0 2.54-1.327 2.647-2.013h-2.647v-1.6h4.406c.041.233.074.467.074.773-.001 2.666-1.787 4.56-4.48 4.56zm11.333-4h-2v2h-1.334v-2h-2v-1.333h2v-2h1.334v2h2v1.333z"/></svg></div><?php }?>
				
				<?php if ($_smarty_tpl->tpl_vars['settings']->value->youtube) {?><div title="Youtube" onclick="window.open('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->youtube, ENT_QUOTES, 'UTF-8', true);?>
','_blank');" class="youtube"></div><?php }?>
				<?php if ($_smarty_tpl->tpl_vars['settings']->value->vk) {?><div title="ВКонтакте" onclick="window.open('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->vk, ENT_QUOTES, 'UTF-8', true);?>
','_blank');" class="vk"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 59.59 33.73"><g id="Слой_2" data-name="Слой 2"><g id="Слой_1-2" data-name="Слой 1"><path class="cls-1" fill="#231f20" fill-rule="evenodd" d="M51.29,21.44c2,1.93,4.06,3.75,5.84,5.87a17.47,17.47,0,0,1,2.09,3c.8,1.55.07,3.27-1.32,3.36H49.22a6.7,6.7,0,0,1-5.53-2.25c-1.21-1.22-2.32-2.53-3.47-3.79a8,8,0,0,0-1.57-1.39,1.82,1.82,0,0,0-2.89.7A9.16,9.16,0,0,0,34.85,31c-.09,2.05-.71,2.59-2.77,2.68A22.22,22.22,0,0,1,19.66,31a27.42,27.42,0,0,1-8.36-7.83A105.7,105.7,0,0,1,.3,3.58C-.39,2,.11,1.21,1.82,1.18q4.25-.09,8.5,0a2.5,2.5,0,0,1,2.36,1.77,52.35,52.35,0,0,0,5.76,10.67A9,9,0,0,0,20.61,16a1.33,1.33,0,0,0,2.25-.67,7.15,7.15,0,0,0,.5-2.23,32.73,32.73,0,0,0-.14-7.85,3.26,3.26,0,0,0-2.78-3c-.83-.16-.71-.47-.31-.94A3.13,3.13,0,0,1,22.79,0h9.82c1.54.31,1.88,1,2.1,2.55v10.9c0,.6.3,2.39,1.39,2.79.87.28,1.44-.41,2-1a33.77,33.77,0,0,0,5.52-8.49c.67-1.35,1.24-2.74,1.79-4.13a2.1,2.1,0,0,1,2.22-1.52H57a4.68,4.68,0,0,1,.84.05c1.59.27,2,1,1.53,2.51a23.49,23.49,0,0,1-3.75,6.51c-1.58,2.18-3.26,4.28-4.82,6.47C49.39,18.7,49.51,19.7,51.29,21.44Z"/></g></g></svg> </div><?php }?>
				<?php if ($_smarty_tpl->tpl_vars['settings']->value->facebook) {?><div title="Facebook" onclick="window.open('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->facebook, ENT_QUOTES, 'UTF-8', true);?>
','_blank');" class="facebook"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 37.51 37.51"><g id="Слой_2" data-name="Слой 2"><g id="Слой_1-2" data-name="Слой 1"><path class="cls-1" fill="#231f20" d="M37.51,6.25A6.48,6.48,0,0,0,31.26,0h-25A6.48,6.48,0,0,0,0,6.25v25a6.48,6.48,0,0,0,6.25,6.25H18.76V23.34H14.17V17.09h4.59V14.65c0-4.2,3.15-8,7-8h5.05v6.25H25.79a1.53,1.53,0,0,0-1.2,1.68v2.49h6.25v6.25H24.59V37.51h6.67a6.47,6.47,0,0,0,6.25-6.25Z"/></g></g></svg> </div><?php }?>
				<?php if ($_smarty_tpl->tpl_vars['settings']->value->insta) {?><div title="Instagram" onclick="window.open('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->insta, ENT_QUOTES, 'UTF-8', true);?>
','_blank');" class="insta"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 37.51 37.51"><g id="Слой_2" data-name="Слой 2"><g id="Слой_1-2" data-name="Слой 1"><path class="cls-1" fill="#231f20" d="M27.16,0H10.35A10.36,10.36,0,0,0,0,10.35V27.16A10.36,10.36,0,0,0,10.35,37.51H27.16A10.36,10.36,0,0,0,37.51,27.16V10.35A10.36,10.36,0,0,0,27.16,0Zm7,27.16a7,7,0,0,1-7,7H10.35a7,7,0,0,1-7-7V10.35a7,7,0,0,1,7-7H27.16a7,7,0,0,1,7,7Z"/><path class="cls-1" d="M18.76,9.09a9.67,9.67,0,1,0,9.66,9.67,9.68,9.68,0,0,0-9.66-9.67Zm0,16a6.34,6.34,0,1,1,6.34-6.33,6.34,6.34,0,0,1-6.34,6.33Z"/><path class="cls-1" d="M28.83,6.27a2.44,2.44,0,0,0,0,4.88A2.45,2.45,0,0,0,30.56,7a2.5,2.5,0,0,0-1.73-.71Z"/></g></g></svg> </div><?php }?>
				<?php if ($_smarty_tpl->tpl_vars['settings']->value->viber) {?><div title="Viber" onclick="window.open('viber:chat?number=<?php echo $_smarty_tpl->tpl_vars['settings']->value->viber;?>
','_blank');"class="viber"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" fill="#231f20"><path d="M19 24h-14c-2.761 0-5-2.239-5-5v-14c0-2.761 2.239-5 5-5h14c2.762 0 5 2.239 5 5v14c0 2.761-2.238 5-5 5zm-.806-17.791c-.419-.386-2.114-1.616-5.887-1.633 0 0-4.451-.268-6.62 1.722-1.207 1.208-1.632 2.974-1.677 5.166-.045 2.192-.103 6.298 3.855 7.411l.004.001-.002 1.699s-.025.688.427.828c.548.17.87-.353 1.393-.916.287-.309.683-.764.982-1.111 2.707.227 4.789-.293 5.026-.37.547-.178 3.639-.574 4.142-4.679.519-4.234-.251-6.911-1.643-8.118zm.458 7.812c-.425 3.428-2.933 3.645-3.395 3.793-.197.063-2.026.518-4.325.368 0 0-1.714 2.067-2.249 2.605-.083.084-.181.118-.247.102-.092-.023-.118-.132-.116-.291l.014-2.824c-3.348-.93-3.153-4.425-3.115-6.255.038-1.83.382-3.33 1.403-4.338 1.835-1.662 5.615-1.414 5.615-1.414 3.192.014 4.722.976 5.077 1.298 1.177 1.008 1.777 3.421 1.338 6.956zm-6.025.206s.3.026.461-.174l.315-.396c.152-.196.519-.322.878-.122.475.268 1.09.69 1.511 1.083.232.196.286.484.128.788l-.002.006c-.162.288-.38.557-.655.807l-.006.005c-.309.258-.665.408-1.046.284l-.007-.01c-.683-.193-2.322-1.029-3.367-1.862-1.709-1.349-2.923-3.573-3.26-4.765l-.01-.007c-.124-.382.027-.738.284-1.046l.005-.006c.251-.275.52-.492.807-.655l.006-.001c.304-.159.592-.105.788.127.258.267.743.908 1.083 1.511.2.359.075.726-.122.878l-.396.315c-.2.161-.174.461-.174.461s.586 2.219 2.779 2.779zm3.451-1.84c.118-.001.213-.097.212-.215-.011-1.404-.441-2.531-1.278-3.348-.835-.814-1.887-1.231-3.126-1.24h-.001c-.117 0-.213.094-.214.212 0 .118.094.214.212.215 1.125.008 2.078.384 2.831 1.119.753.734 1.139 1.759 1.149 3.046.001.117.096.211.213.211h.002zm-1.123-.438h-.005c-.118-.003-.211-.1-.208-.218.016-.73-.192-1.32-.637-1.806-.443-.484-1.051-.749-1.86-.808-.117-.009-.206-.111-.197-.228.009-.118.111-.206.228-.198.91.067 1.631.385 2.144.946.515.562.767 1.27.748 2.103-.002.117-.097.209-.213.209zm-1.095-.367c-.113 0-.207-.089-.213-.203-.036-.724-.377-1.079-1.074-1.116-.117-.007-.208-.107-.201-.225.006-.117.106-.208.224-.201.919.049 1.43.575 1.477 1.521.006.118-.084.218-.202.224h-.011z"/></svg></div><?php }?>
				<?php if ($_smarty_tpl->tpl_vars['settings']->value->whatsapp) {?><div title="Whatsapp" onclick="window.open('https:api.whatsapp.com/send?phone=<?php echo $_smarty_tpl->tpl_vars['settings']->value->whatsapp;?>
','_blank');" class="whatsapp"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#231f20"><path d="M12.036 5.339c-3.635 0-6.591 2.956-6.593 6.589-.001 1.483.434 2.594 1.164 3.756l-.666 2.432 2.494-.654c1.117.663 2.184 1.061 3.595 1.061 3.632 0 6.591-2.956 6.592-6.59.003-3.641-2.942-6.593-6.586-6.594zm3.876 9.423c-.165.463-.957.885-1.337.942-.341.051-.773.072-1.248-.078-.288-.091-.657-.213-1.129-.417-1.987-.858-3.285-2.859-3.384-2.991-.099-.132-.809-1.074-.809-2.049 0-.975.512-1.454.693-1.653.182-.2.396-.25.528-.25l.38.007c.122.006.285-.046.446.34.165.397.561 1.372.611 1.471.049.099.083.215.016.347-.066.132-.099.215-.198.33l-.297.347c-.099.099-.202.206-.087.404.116.198.513.847 1.102 1.372.757.675 1.395.884 1.593.983.198.099.314.083.429-.05.116-.132.495-.578.627-.777s.264-.165.446-.099 1.156.545 1.354.645c.198.099.33.149.38.231.049.085.049.482-.116.945zm3.088-14.762h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-6.967 19.862c-1.327 0-2.634-.333-3.792-.965l-4.203 1.103 1.125-4.108c-.694-1.202-1.059-2.566-1.058-3.964.002-4.372 3.558-7.928 7.928-7.928 2.121.001 4.112.827 5.609 2.325s2.321 3.491 2.32 5.609c-.002 4.372-3.559 7.928-7.929 7.928z"/></svg></div><?php }?>
				<?php if ($_smarty_tpl->tpl_vars['settings']->value->odnoklassniki) {?><div title="Одноклассники" onclick="window.open('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->odnoklassniki, ENT_QUOTES, 'UTF-8', true);?>
','_blank');" class="ok"> <svg role="img" focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" fill="#231f20"><path d="M 8.2624472,9.720363 C 8.8999741,9.575357 9.5089991,9.323347 10.062522,8.975332 10.479539,8.696321 10.591544,8.132297 10.312533,7.71528 10.044521,7.314263 9.5104991,7.193258 9.0949821,7.438768 c -1.2750533,0.797534 -2.8951208,0.797534 -4.170174,0 C 4.5012905,7.171757 3.9422672,7.298762 3.674756,7.72128 c 0,10e-4 0,0.002 -10e-4,0.0025 -0.2670111,0.423518 -0.1400058,0.983041 0.2835118,1.250052 l 10e-4,10e-4 c 0.552523,0.347515 1.1610483,0.600025 1.7980749,0.744031 l -1.7325722,1.732572 c -0.3535147,0.347515 -0.360015,0.915039 -0.014001,1.268553 l 0.015001,0.015 C 4.1967778,12.911996 4.4297875,13 4.6617972,13 4.8943069,13 5.1268165,12.912 5.2993237,12.734989 l 1.7105713,-1.702071 1.7020711,1.703071 c 0.360015,0.347514 0.935039,0.338014 1.283053,-0.0225 0.3390139,-0.351515 0.3390139,-0.909038 0,-1.260052 L 8.2624472,9.720363 Z M 7.009895,7.194258 C 8.7199661,7.192258 10.105024,5.8072 10.107524,4.097629 10.107524,2.390058 8.7174661,1 7.009895,1 5.3023239,1 3.9122659,2.390058 3.9122659,4.098629 3.9147659,5.8087 5.3003238,7.193758 7.009895,7.194758 Z m 0,-4.378682 c 0.7080295,10e-4 1.2815534,0.575024 1.2820534,1.282553 0,0.70803 -0.5740239,1.281553 -1.2820534,1.282554 C 6.3023655,5.379683 5.7288416,4.806659 5.7273416,4.098629 5.7283416,3.3901 6.3023655,2.816576 7.009895,2.815076 Z"/></svg> </div><?php }?>
				<?php if ($_smarty_tpl->tpl_vars['settings']->value->telegram) {?><div title="Telegram" onclick="window.open('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->telegram, ENT_QUOTES, 'UTF-8', true);?>
','_blank');" class="telegram"><svg width="24px" height="24px" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;" fill="#231f20"><path id="telegram-3" d="M19,24l-14,0c-2.761,0 -5,-2.239 -5,-5l0,-14c0,-2.761 2.239,-5 5,-5l14,0c2.762,0 5,2.239 5,5l0,14c0,2.761 -2.238,5 -5,5Zm-2.744,-5.148c0.215,0.153 0.491,0.191 0.738,0.097c0.246,-0.093 0.428,-0.304 0.483,-0.56c0.579,-2.722 1.985,-9.614 2.512,-12.09c0.039,-0.187 -0.027,-0.381 -0.173,-0.506c-0.147,-0.124 -0.351,-0.16 -0.532,-0.093c-2.795,1.034 -11.404,4.264 -14.923,5.567c-0.223,0.082 -0.368,0.297 -0.361,0.533c0.008,0.235 0.167,0.44 0.395,0.509c1.578,0.471 3.65,1.128 3.65,1.128c0,0 0.967,2.924 1.472,4.41c0.063,0.187 0.21,0.334 0.402,0.384c0.193,0.05 0.397,-0.002 0.541,-0.138c0.811,-0.765 2.064,-1.948 2.064,-1.948c0,0 2.381,1.746 3.732,2.707Zm-7.34,-5.784l1.119,3.692l0.249,-2.338c0,0 4.324,-3.9 6.79,-6.124c0.072,-0.065 0.082,-0.174 0.022,-0.251c-0.06,-0.077 -0.169,-0.095 -0.251,-0.043c-2.857,1.825 -7.929,5.064 -7.929,5.064Z"/></svg></div><?php }?>
			</div> </footer>


	<?php if ($_smarty_tpl->tpl_vars['uagent']->value == 'ios' && $_smarty_tpl->tpl_vars['module']->value != 'MainView') {?>
	<a href="javascript:history.go(-1)" class="history_back">&lang;</a>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['module']->value == 'CartView') {?>
		<?php echo '<script'; ?>
 src="androidcore/baloon/js/baloon.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php }?>
	<?php echo '<script'; ?>
 type="text/javascript" src="androidcore/core2.js?v=<?php echo filemtime('androidcore/core2.js');?>
"><?php echo '</script'; ?>
> <?php echo '<script'; ?>
>
		$(function() {
			$(".zoom").fancybox({ 'hideOnContentClick' : true });
		});
		// .image_half_width open in modal
		$("img.image-half-width, .image-half-width img").click(function(){
			$.fancybox({ 'href' : $(this).attr('src') , 'hideOnContentClick' : true });
		})
	<?php echo '</script'; ?>
>

	<?php if ($_smarty_tpl->tpl_vars['module']->value == 'MainView') {?>
		<?php echo '<script'; ?>
 type="text/javascript">
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
		<?php echo '</script'; ?>
> <?php echo '<script'; ?>
 type="text/javascript">
			// убирание под кат
			heightt=$('.top .cutinner').height();	
			if(heightt<<?php echo $_smarty_tpl->tpl_vars['settings']->value->cutmob;?>
){
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
		<?php echo '</script'; ?>
>
	<?php }?>

	<?php if (in_array($_smarty_tpl->tpl_vars['module']->value,array('BlogView','FeedbackView','LoginView','RegisterView','UserView','ProductView'))) {?>
		<?php echo '<script'; ?>
 defer src="androidcore/baloon/js/baloon.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['module']->value == 'ProductsView') {?>
		
		<?php echo '<script'; ?>
 src="androidcore/priceslider.js" type="text/javascript"><?php echo '</script'; ?>
>
		<?php if (!empty($_smarty_tpl->tpl_vars['keyword']->value) || (!empty($_smarty_tpl->tpl_vars['category']->value->brands) && count($_smarty_tpl->tpl_vars['category']->value->brands) > 1) || !empty($_smarty_tpl->tpl_vars['features']->value) || (isset($_smarty_tpl->tpl_vars['minCost']->value) && isset($_smarty_tpl->tpl_vars['maxCost']->value) && $_smarty_tpl->tpl_vars['minCost']->value < $_smarty_tpl->tpl_vars['maxCost']->value)) {?>
					<?php }?>
		<?php echo '<script'; ?>
 type="text/javascript">
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
			if(heightb<<?php echo $_smarty_tpl->tpl_vars['settings']->value->cutmob;?>
){
				$('.bottom.cutouter').addClass('fullheight');
				$('.bottom .disappear').hide();
			} else {
				$('.bottom.cutmore').show();
			}
			heightt=$('.top .cutinner').height();	
			if(heightt<<?php echo $_smarty_tpl->tpl_vars['settings']->value->cutmob;?>
){
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
		<?php echo '</script'; ?>
>
	<?php }?>
	
	<?php if (in_array($_smarty_tpl->tpl_vars['module']->value,array('ProductsView','ArticlesView','BlogView','SurveysView')) && !empty($_smarty_tpl->tpl_vars['total_pages_num']->value) && $_smarty_tpl->tpl_vars['total_pages_num']->value > 1) {?>
					<?php echo '<script'; ?>
 type="text/javascript">
				$('.infinite_prev').show();
				var offset = 800; // start next page
				var scroll_timeout = 100; // window scroll throttle setTimeout
				<?php if ($_smarty_tpl->tpl_vars['module']->value == 'ProductsView') {?>var update_products = 1;<?php }?>
			<?php echo '</script'; ?>
> <?php echo '<script'; ?>
 type="text/javascript" src="androidcore/infinite_ajax.js"><?php echo '</script'; ?>
>
			<?php }?>
	
	<?php if ($_smarty_tpl->tpl_vars['module']->value == 'ProductView') {?>
		<?php echo '<script'; ?>
 type="text/javascript" src="androidcore/product.js"><?php echo '</script'; ?>
> <?php echo '<script'; ?>
 src="js/rating/project.js"><?php echo '</script'; ?>
> <?php echo '<script'; ?>
 type="text/javascript">
			$(function() { 
				$('.testRater').rater({ postHref: 'ajax/rating.php' }); 
			});
		<?php echo '</script'; ?>
> <?php echo '<script'; ?>
>
		// Amount change
		$(window).load(function() {
			stock=parseInt($('select[name=variant]').find('option:selected').attr('v_stock'));
			if( !$.isNumeric(stock) ){ stock = <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->max_order_amount, ENT_QUOTES, 'UTF-8', true);?>
; }
			$('.variants .amount').attr('data-max',stock);
		});
		$('select[name=variant]').change(function(){
			stock=parseInt($(this).find('option:selected').attr('v_stock'));
			if( !$.isNumeric(stock) ) 
				stock = <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->max_order_amount, ENT_QUOTES, 'UTF-8', true);?>
;
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
				if( !$.isNumeric(maxamount) ){ maxamount = <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->max_order_amount, ENT_QUOTES, 'UTF-8', true);?>
; $('#amount .amount').attr('data-max',maxamount);}
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
				if( !$.isNumeric(maxamount) ){ maxamount = <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->max_order_amount, ENT_QUOTES, 'UTF-8', true);?>
; $('#amount .amount').attr('data-max',maxamount);}
		
				if(oldamount < maxamount)
					$input.val(oldamount + 1);
				else
					$input.val(maxamount);
				$input.change();
				return false;
			});
		});
		<?php echo '</script'; ?>
> <?php echo '<script'; ?>
>
			$(function() {
				$(".various").fancybox({
					'hideOnContentClick' : false,
					'hideOnOverlayClick' : false,
					'onComplete': function() { $('body').css('overflow','hidden');},
					'onClosed': function() { $('body').css('overflow','visible');}
                });
			});
		<?php echo '</script'; ?>
> <?php echo '<script'; ?>
 defer type="text/javascript" src="js/superembed.min.js"><?php echo '</script'; ?>
> <?php echo '<script'; ?>
 type="text/javascript">$('#tab1 iframe').addClass('superembed-force')<?php echo '</script'; ?>
>
	<?php }?>
	
	<?php if (in_array($_smarty_tpl->tpl_vars['module']->value,array('ArticlesView','BlogView','ServicesView')) && (!empty($_smarty_tpl->tpl_vars['post']->value->images) || !empty($_smarty_tpl->tpl_vars['service']->value->images))) {?>
				<?php echo '<script'; ?>
 src="js/swipebox/jquery.swipebox.min.js"><?php echo '</script'; ?>
> <link type="text/css" rel="stylesheet" href="js/swipebox/swipebox.css"/> <?php echo '<script'; ?>
>
		$(function() { 
			$(".swipebox").swipebox({ hideBarsDelay : 0 });
		});
		<?php echo '</script'; ?>
>
	<?php }?>

	<div class="mainloader" style="display:none;"> <div class="loaderspinner"> <div class="cssload-loader"> <div class="cssload-inner cssload-one"></div> <div class="cssload-inner cssload-two"></div> <div class="cssload-inner cssload-three"></div> </div> </div> </div>
	
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_forms'][0], array( array('var'=>'forms','url'=>$_SERVER['REQUEST_URI']),$_smarty_tpl ) );?>

	<?php if ($_smarty_tpl->tpl_vars['forms']->value) {?>
		<!--noindex--> <div style="display:none;">	
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['forms']->value, 'form');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['form']->value) {
?>
				<?php if ($_smarty_tpl->tpl_vars['form']->value->visible) {?>
				<div id="form<?php echo $_smarty_tpl->tpl_vars['form']->value->id;?>
" class="user_form"> <div class="user_form_main"> <div class="form-title"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</div> <div class="readform"> <input name="f-subject" placeholder="Форма" type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" />
							<?php echo $_smarty_tpl->tpl_vars['form']->value->description;?>

						</div>
						<?php $_smarty_tpl->_subTemplateRender('file:conf.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
						<?php $_smarty_tpl->_subTemplateRender('file:antibot.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
						<div data-formid="form<?php echo $_smarty_tpl->tpl_vars['form']->value->id;?>
" class="buttonred hideablebutton"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form']->value->button, ENT_QUOTES, 'UTF-8', true);?>
</div> </div> <div class="form_result"></div> </div>
				<?php }?>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</div> <!--/noindex-->
	<?php }?>
		

		<?php echo '<script'; ?>
 src="design/mobile/js/custom.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php if (!empty($_smarty_tpl->tpl_vars['mobile_app']->value)) {?>
						<?php echo '<script'; ?>
 type="text/javascript">
			try { 
				Search.sendSearch("<?php if ($_smarty_tpl->tpl_vars['module']->value == 'BlogView') {?>blog<?php } elseif ($_smarty_tpl->tpl_vars['module']->value == 'ArticlesView') {?>articles<?php } elseif ($_smarty_tpl->tpl_vars['module']->value == 'ServicesView') {?>services<?php } else {
if ($_smarty_tpl->tpl_vars['settings']->value->purpose == 0) {?>products<?php } elseif ($_smarty_tpl->tpl_vars['settings']->value->purpose == 1) {?>services<?php }
}?>");
			} catch(e) {};
		<?php echo '</script'; ?>
>
						<div id="cart_informer" style="display:none;">
			<?php $_smarty_tpl->_subTemplateRender('file:cart_informer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		</div>
						<?php echo '<script'; ?>
>
			try { 
								window.webkit.messageHandlers.search.postMessage("<?php if ($_smarty_tpl->tpl_vars['module']->value == 'BlogView') {?>blog<?php } elseif ($_smarty_tpl->tpl_vars['module']->value == 'ArticlesView') {?>articles<?php } elseif ($_smarty_tpl->tpl_vars['module']->value == 'ServicesView') {?>services<?php } elseif ($_smarty_tpl->tpl_vars['settings']->value->purpose == 0) {?>products<?php } elseif ($_smarty_tpl->tpl_vars['settings']->value->purpose == 1) {?>services<?php }?>");
			} catch(e) {};
		<?php echo '</script'; ?>
>
			<?php } else { ?>
		<?php echo '<script'; ?>
>
			$(window).load(function() { 
			var swipem = new MobiSwipe("body");
			swipem.direction = swipem.HORIZONTAL;
			swipem.onswipeleft = function() {
				if ( $('#catalog').hasClass('showcat') ) {
					hideShowOverlay(this);
				}
				return!1};
			});
		<?php echo '</script'; ?>
>
	<?php }?>
		
	<div style="display:none;">
		<?php if ($_smarty_tpl->tpl_vars['settings']->value->counters) {?>
			<!-- Yandex.Metrika counter --> <?php echo '<script'; ?>
 type="text/javascript" > (function(m,e,t,r,i,k,a){ m[i]=m[i]||function(){ (m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(<?php echo $_smarty_tpl->tpl_vars['settings']->value->counters;?>
, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, ecommerce:"dataLayer" }); <?php echo '</script'; ?>
> <noscript><div><img src="https://mc.yandex.ru/watch/<?php echo $_smarty_tpl->tpl_vars['settings']->value->counters;?>
" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
		<?php }?>
			</div> <?php echo '<script'; ?>
 type="text/javascript">
	
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
	
	<?php echo '</script'; ?>
>
	
		<svg style="display:none;"> <symbol id="arrow_tool" viewBox="0 0 24 24"> <path d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z"/> <path d="M0-.25h24v24H0z" fill="none"/> </symbol> <symbol id="uncheckedconf" viewBox="0 0 24 24"> <path d="M19 5v14H5V5h14m0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/> <path d="M0 0h24v24H0z" fill="none"/> </symbol> <symbol id="checkedconf" viewBox="0 0 24 24"> <path d="M0 0h24v24H0z" fill="none"/> <path d="M19 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.11 0 2-.9 2-2V5c0-1.1-.89-2-2-2zm-9 14l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/> </symbol> <symbol id="antibotchecked" viewBox="0 0 24 24"> <path fill="none" d="M0 0h24v24H0z"/> <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/> </symbol> <symbol id="no_photo" viewBox="0 0 24 24"> <circle cx="12" cy="12" r="3.2"></circle> <path d="M9 2L7.17 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2h-3.17L15 2H9zm3 15c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5z"></path> <path d="M0 0h24v24H0z" fill="none"></path> </symbol> <symbol id="folder" viewBox="0 0 24 24"> <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"/><path d="M0 0h24v24H0z" fill="none"/> </symbol> <symbol id="hit" viewBox="0 0 24 24"> <path d="M16.23,18L12,15.45L7.77,18L8.89,13.19L5.16,9.96L10.08,9.54L12,5L13.92,9.53L18.84,9.95L15.11,13.18L16.23,18M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" /> </symbol> <symbol id="new" viewBox="0 0 24 24"> <path d="M20,4C21.11,4 22,4.89 22,6V18C22,19.11 21.11,20 20,20H4C2.89,20 2,19.11 2,18V6C2,4.89 2.89,4 4,4H20M8.5,15V9H7.25V12.5L4.75,9H3.5V15H4.75V11.5L7.3,15H8.5M13.5,10.26V9H9.5V15H13.5V13.75H11V12.64H13.5V11.38H11V10.26H13.5M20.5,14V9H19.25V13.5H18.13V10H16.88V13.5H15.75V9H14.5V14A1,1 0 0,0 15.5,15H19.5A1,1 0 0,0 20.5,14Z" /> </symbol> <symbol id="lowprice" viewBox="0 0 24 24"> <path d="M18.65,2.85L19.26,6.71L22.77,8.5L21,12L22.78,15.5L19.24,17.29L18.63,21.15L14.74,20.54L11.97,23.3L9.19,20.5L5.33,21.14L4.71,17.25L1.22,15.47L3,11.97L1.23,8.5L4.74,6.69L5.35,2.86L9.22,3.5L12,0.69L14.77,3.46L18.65,2.85M9.5,7A1.5,1.5 0 0,0 8,8.5A1.5,1.5 0 0,0 9.5,10A1.5,1.5 0 0,0 11,8.5A1.5,1.5 0 0,0 9.5,7M14.5,14A1.5,1.5 0 0,0 13,15.5A1.5,1.5 0 0,0 14.5,17A1.5,1.5 0 0,0 16,15.5A1.5,1.5 0 0,0 14.5,14M8.41,17L17,8.41L15.59,7L7,15.59L8.41,17Z" /> </symbol> <symbol id="brands" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path opacity=".3" d="M12 11h2v2h-2v2h2v2h-2v2h8V9h-8v2zm4 0h2v2h-2v-2zm0 4h2v2h-2v-2z"/><path d="M16 15h2v2h-2zm0-4h2v2h-2zm6-4H12V3H2v18h20V7zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10z"/> </symbol>
		<?php if (in_array($_smarty_tpl->tpl_vars['module']->value,array('BlogView','ArticlesView','TagsView','MainView'))) {?>
		<symbol id="calendar" viewBox="0 0 24 24"> <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/> <path d="M0 0h24v24H0z" fill="none"/> </symbol> <symbol id="views" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0V0z"/><path d="M16.24 7.75c-1.17-1.17-2.7-1.76-4.24-1.76v6l-4.24 4.24c2.34 2.34 6.14 2.34 8.49 0 2.34-2.34 2.34-6.14-.01-8.48zM12 1.99c-5.52 0-10 4.48-10 10s4.48 10 10 10 10-4.48 10-10-4.48-10-10-10zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/> </symbol> <symbol id="comments_count" viewBox="0 0 24 24"> <path d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M17,11H15V9H17V11M13,11H11V9H13V11M9,11H7V9H9V11Z" /> </symbol>
		<?php }?>
		<?php if (in_array($_smarty_tpl->tpl_vars['module']->value,array('ProductsView','ProductView','MainView','PageView'))) {?>
		<symbol id="activec" viewBox='0 0 24 24'> <path d='M12 6v3l4-4-4-4v3c-4.42 0-8 3.58-8 8 0 1.57.46 3.03 1.24 4.26L6.7 14.8c-.45-.83-.7-1.79-.7-2.8 0-3.31 2.69-6 6-6zm6.76 1.74L17.3 9.2c.44.84.7 1.79.7 2.8 0 3.31-2.69 6-6 6v-3l-4 4 4 4v-3c4.42 0 8-3.58 8-8 0-1.57-.46-3.03-1.24-4.26z'/> <path d='M0 0h24v24H0z' fill='none'/> </symbol> <symbol id="basec" viewBox="0 0 24 24"> <path d="M19 8l-4 4h3c0 3.31-2.69 6-6 6-1.01 0-1.97-.25-2.8-.7l-1.46 1.46C8.97 19.54 10.43 20 12 20c4.42 0 8-3.58 8-8h3l-4-4zM6 12c0-3.31 2.69-6 6-6 1.01 0 1.97.25 2.8.7l1.46-1.46C15.03 4.46 13.57 4 12 4c-4.42 0-8 3.58-8 8H1l4 4 4-4H6z"/> <path d="M0 0h24v24H0z" fill="none"/> </symbol> <symbol id="activew" viewBox='0 0 24 24'> <path d='M0 0h24v24H0z' fill='none'/> <path d='M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z'/> </symbol> <symbol id="basew" viewBox='0 0 24 24'> <path d='M0 0h24v24H0z' fill='none'/> <path d='M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z'/> </symbol>
		<?php }?>
	</svg>
		
	
	<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->script_footer)) {
echo $_smarty_tpl->tpl_vars['settings']->value->script_footer;
}?>
	
		<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->consultant)) {?>
		<?php echo '<script'; ?>
 id="rhlpscrtg" type="text/javascript" charset="utf-8" async="async" 
			src="https://web.redhelper.ru/service/main.js?c=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->consultant, ENT_QUOTES, 'UTF-8', true);?>
">
		<?php echo '</script'; ?>
> 
	<?php }?>
		
</body> </html><?php }
}
