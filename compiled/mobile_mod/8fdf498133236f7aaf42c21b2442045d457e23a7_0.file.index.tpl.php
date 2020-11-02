<?php
/* Smarty version 3.1.33, created on 2020-11-02 12:14:12
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5f9ff8144e0b41_09250234',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8fdf498133236f7aaf42c21b2442045d457e23a7' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/index.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:toolbar.tpl' => 1,
    'file:conf.tpl' => 1,
    'file:antibot.tpl' => 1,
    'file:cart_informer.tpl' => 1,
  ),
),false)) {
function content_5f9ff8144e0b41_09250234 (Smarty_Internal_Template $_smarty_tpl) {
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
		#menutop{ background-color: #<?php echo $_smarty_tpl->tpl_vars['mobtheme']->value->colorPrimary;?>
; }
		#catalogtopbody svg{ fill: #<?php echo $_smarty_tpl->tpl_vars['mobtheme']->value->colorSecondPrimary;?>
; }
		#catalogtopbody a{ color:#<?php echo $_smarty_tpl->tpl_vars['mobtheme']->value->leftMenuItem;?>
; }
		#catalogtopbody .selected a, #catalogtopbody .filter-active, #catalogtopbody li:hover a{ color:#<?php echo $_smarty_tpl->tpl_vars['mobtheme']->value->leftMenuItemActive;?>
; }
		#catalogtopbody .activeli svg, #catalogtopbody li:hover svg { fill:#<?php echo $_smarty_tpl->tpl_vars['mobtheme']->value->leftMenuIconActive;?>
; }
		#catalogtopbody .activeli, #catalogtopbody li:hover { background-color:#<?php echo $_smarty_tpl->tpl_vars['mobtheme']->value->backgroundAccent;?>
; }
		#catalog svg, #cart_informer svg, #searchblock svg{ fill:#<?php echo $_smarty_tpl->tpl_vars['mobtheme']->value->colorMain;?>
; }
		#menutoptitle{ color:#<?php echo $_smarty_tpl->tpl_vars['mobtheme']->value->colorMain;?>
; }
		.badge{ background-color:#<?php echo $_smarty_tpl->tpl_vars['mobtheme']->value->badgeBackground;?>
;border-color:#<?php echo $_smarty_tpl->tpl_vars['mobtheme']->value->badgeBorder;?>
;color:#<?php echo $_smarty_tpl->tpl_vars['mobtheme']->value->badgeText;?>
;}
		.maincatalog { background-color:#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->sliderbg, ENT_QUOTES, 'UTF-8', true);?>
;color:#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->slidertext, ENT_QUOTES, 'UTF-8', true);?>
; }
		#content .pagination .selected, .pagination .butpag.selected, .pagination .butpag.selected:hover, .htabs a, .buttonred, #content a.buttonred, #content .logreg { background-color:#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->buybg, ENT_QUOTES, 'UTF-8', true);?>
;color:#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->buytext, ENT_QUOTES, 'UTF-8', true);?>
; }
		.pagination .selected { border-color: #<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->buybg, ENT_QUOTES, 'UTF-8', true);?>
 !important; }
		.buttonred:hover, #content .logreg:hover { background-color:#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->buybgactive, ENT_QUOTES, 'UTF-8', true);?>
;color:#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->buytextactive, ENT_QUOTES, 'UTF-8', true);?>
; }
		.addcompare svg, .towish svg, .purchase-remove svg, .wish-remove svg, #comparebody .delete svg, .minfo .nophoto { fill: #<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->wishcomp, ENT_QUOTES, 'UTF-8', true);?>
; }
		.gocompare svg, .inwish svg, .purchase-remove svg:active, .wish-remove svg:active, #comparebody .delete svg:active { fill: #<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->wishcompactive, ENT_QUOTES, 'UTF-8', true);?>
; }
		.breadcrumb { background-color:#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->breadbg, ENT_QUOTES, 'UTF-8', true);?>
;color:#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->breadtext, ENT_QUOTES, 'UTF-8', true);?>
; }
		.upl-trigger-prev, a.titlecomp, .product h3, #content a, .cutmore, .blogmore, .purchasestitle a, .pagination .butpag { color: #<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->zagolovok, ENT_QUOTES, 'UTF-8', true);?>
; }
		.tiny_products .product, .category_products .product { background-color:#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->zagolovokbg, ENT_QUOTES, 'UTF-8', true);?>
;border: 1px solid #<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->productborder, ENT_QUOTES, 'UTF-8', true);?>
; }
		.bonus { background-color:#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->ballovbg, ENT_QUOTES, 'UTF-8', true);?>
; }
		.various, .comment_form .button, #logininput, .register_form .button, .login_form .button, .feedback_form .button, .cart_form .button, #orderform .button, .checkout_button { background-color:#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->oneclickbg, ENT_QUOTES, 'UTF-8', true);?>
 !important;color:#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mobtheme']->value->oneclicktext, ENT_QUOTES, 'UTF-8', true);?>
 !important; }
		<?php if (empty($_smarty_tpl->tpl_vars['mobile_app']->value)) {?>
			#container { z-index: 97;position: relative;top:50px;max-width:1024px;margin: 0 auto; }
			.breadcrumb { position:relative;z-index:9;top:50px; }
			#body .hidefeaturesbtn { top:90px; }
		<?php }?>
	</style> <link rel="stylesheet" type="text/css" href="design/mobile/css/style.css?v=<?php echo filemtime('design/mobile/css/style.css');?>
"/>
	<?php if ($_smarty_tpl->tpl_vars['module']->value == 'SurveysView') {?>
		<link rel="stylesheet" type="text/css" href="design/mobile/css/survey.css?v=<?php echo filemtime("design/mobile/css/survey.css");?>
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
	
	<h1 id="uphere" class="breadcrumb <?php if ($_smarty_tpl->tpl_vars['module']->value == 'SurveysView' && empty($_smarty_tpl->tpl_vars['user']->value->id)) {?>blured<?php }?>"> <!--h1-->
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
					<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->name)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);
}?> 
					<?php if (!empty($_smarty_tpl->tpl_vars['brand']->value->name)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['brand']->value->name, ENT_QUOTES, 'UTF-8', true);
}?> 
				<?php } elseif ($_smarty_tpl->tpl_vars['module']->value == 'ProductView') {?>
					<?php if (!empty($_smarty_tpl->tpl_vars['product']->value->name)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->name, ENT_QUOTES, 'UTF-8', true);
}?>
				<?php }?>
			<?php }?>
		<?php }?>
		<!--/h1--> </h1>
	<?php }?>

	<div id="container" <?php if ($_smarty_tpl->tpl_vars['module']->value == 'SurveysView' && empty($_smarty_tpl->tpl_vars['user']->value->id)) {?>class="blured"<?php }?>> <div id="content" <?php if ($_smarty_tpl->tpl_vars['module']->value) {?>class="<?php echo mb_strtolower($_smarty_tpl->tpl_vars['module']->value, 'UTF-8');?>
"<?php }?>>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		</div> </div>
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
			<div class="hidefeaturesbtn" onclick="hideFeatures(this);return false;"> <svg viewBox="0 0 24 24"> <path d="M3,2H21V2H21V4H20.92L14,10.92V22.91L10,18.91V10.91L3.09,4H3V2Z" /> </svg> </div>
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
> <style>
		.comment_list li ul li, ul.stars li, #annot ul li, .description ul li, .annotation ul li, .box .main-text ul li, #content .blog-pg ul li, #content .post-pg ul li, #content .page-pg ul li, .post-annotation ul div { background:url("js/bullets/<?php echo $_smarty_tpl->tpl_vars['settings']->value->bullet;?>
.png") 0px 8px no-repeat transparent; }
	</style>
	
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
