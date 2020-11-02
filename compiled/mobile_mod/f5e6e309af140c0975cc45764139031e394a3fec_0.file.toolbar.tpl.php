<?php
/* Smarty version 3.1.33, created on 2020-11-02 12:14:12
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/toolbar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5f9ff814596955_97048551',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f5e6e309af140c0975cc45764139031e394a3fec' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/toolbar.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:cart_informer.tpl' => 1,
    'file:marticlescat.tpl' => 1,
    'file:mservicescat.tpl' => 2,
    'file:mblog_cat.tpl' => 1,
    'file:mcatalog.tpl' => 1,
  ),
),false)) {
function content_5f9ff814596955_97048551 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- incl. toolbar --> <div id="menutop"> <div id="menutopbody"> <div id="catalog" onclick="hideShowMenu(this);return false;"> <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M0 0h24v24H0z" fill="none"/> <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/> </svg> </div> <div id="menutoptitle">
			<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->site_name, ENT_QUOTES, 'UTF-8', true);?>

		</div>
		<?php if ($_smarty_tpl->tpl_vars['settings']->value->purpose == 0 || in_array($_smarty_tpl->tpl_vars['module']->value,array('CartView','OrderView','ProductView','ProductsView'))) {?>
			<div id="cart_informer" onclick="window.location='cart'">
				<?php $_smarty_tpl->_subTemplateRender('file:cart_informer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			</div>
		<?php }?>
		<div id="searchblock" onclick="hideShowSearch(this);return false;"> <svg class="hideloupe" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/> <path d="M0 0h24v24H0z" fill="none"/> </svg> <svg style="display:none" class="hidecross" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/> <path d="M0 0h24v24H0z" fill="none"/> </svg> </div> </div> </div> <div id="searchtop" style="display:none;"> <div id="searchtopbody"> <div id="search">
			<?php if ($_smarty_tpl->tpl_vars['module']->value == 'BlogView') {?>
				<form action="blog">
										<input class="input_search" type="text" name="keyword" value="<?php if (isset($_smarty_tpl->tpl_vars['keyword']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['keyword']->value, ENT_QUOTES, 'UTF-8', true);
}?>" placeholder="Поиск в блоге" autocomplete="off"/> </form>
			<?php } elseif ($_smarty_tpl->tpl_vars['module']->value == 'ArticlesView') {?>
				<form action="articles"> <input class="input_search" type="text" name="keyword" value="<?php if (isset($_smarty_tpl->tpl_vars['keyword']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['keyword']->value, ENT_QUOTES, 'UTF-8', true);
}?>" placeholder="Поиск в статьях" autocomplete="off"/> </form>
			<?php } elseif ($_smarty_tpl->tpl_vars['module']->value == 'ServicesView') {?>
				<form action="services"> <input class="input_search" type="search" name="keyword" value="<?php if (isset($_smarty_tpl->tpl_vars['keyword']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['keyword']->value, ENT_QUOTES, 'UTF-8', true);
}?>" placeholder="Поиск в услугах" autocomplete="off"/> </form>
			<?php } else { ?>
				<?php if ($_smarty_tpl->tpl_vars['settings']->value->purpose == 0 || in_array($_smarty_tpl->tpl_vars['module']->value,array('ProductView','ProductsView','CartView','OrderView','BrowsedView','CompareView','WishlistView'))) {?>
					<form action="products"> <input class="input_search newsearch" type="search" name="keyword" value="<?php if (isset($_smarty_tpl->tpl_vars['keyword']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['keyword']->value, ENT_QUOTES, 'UTF-8', true);
}?>" placeholder="Поиск товара" autocomplete="off"/> </form>
				<?php } elseif ($_smarty_tpl->tpl_vars['settings']->value->purpose == 1) {?>
					<form action="services"> <input class="input_search" type="search" name="keyword" value="<?php if (isset($_smarty_tpl->tpl_vars['keyword']->value)) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['keyword']->value, ENT_QUOTES, 'UTF-8', true);
}?>" placeholder="Поиск в услугах" autocomplete="off"/> </form>
				<?php }?>
			<?php }?>
		</div> </div> </div> <div id="catalogtop"> <div id="logo"> <img onclick="window.location='/'" src="files/logo/logo.png?v=<?php echo filemtime('files/logo/logo.png');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->site_name, ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->site_name, ENT_QUOTES, 'UTF-8', true);?>
" /> </div> <div id="catalogtopbody">
		<?php if ($_smarty_tpl->tpl_vars['module']->value == 'ArticlesView') {?>
			<?php $_smarty_tpl->_subTemplateRender('file:marticlescat.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php if (!empty($_smarty_tpl->tpl_vars['categories']->value)) {?>
			<ul class="dropdown-menu svg"> <li> <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M0 0h24v24H0z" fill="none"/> <path d="M20 13H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1zM7 19c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zM20 3H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1zM7 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/> </svg> <a href="<?php if ($_smarty_tpl->tpl_vars['settings']->value->purpose == 0) {?>catalog<?php } else { ?>services<?php }?>" title="Каталог">Каталог</a> </li> </ul>
			<?php }?>
		<?php } elseif ($_smarty_tpl->tpl_vars['module']->value == 'ServicesView') {?>
			<?php $_smarty_tpl->_subTemplateRender('file:mservicescat.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php if (!empty($_smarty_tpl->tpl_vars['categories']->value) && $_smarty_tpl->tpl_vars['settings']->value->purpose == 0) {?>
			<ul class="dropdown-menu svg"> <li> <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M0 0h24v24H0z" fill="none"/> <path d="M20 13H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1zM7 19c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zM20 3H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1zM7 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/> </svg> <a href="catalog" title="Каталог">Каталог</a> </li> </ul>
			<?php }?>
		<?php } elseif ($_smarty_tpl->tpl_vars['module']->value == 'BlogView' && !empty($_smarty_tpl->tpl_vars['blog_categories']->value)) {?>
			<?php $_smarty_tpl->_subTemplateRender('file:mblog_cat.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php if (!empty($_smarty_tpl->tpl_vars['categories']->value)) {?>
			<ul class="dropdown-menu svg"> <li> <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M0 0h24v24H0z" fill="none"/> <path d="M20 13H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1zM7 19c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zM20 3H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h16c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1zM7 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/> </svg> <a href="<?php if ($_smarty_tpl->tpl_vars['settings']->value->purpose == 0) {?>catalog<?php } else { ?>services<?php }?>" title="Каталог">Каталог</a> </li> </ul>
			<?php }?>
		<?php } elseif ($_smarty_tpl->tpl_vars['settings']->value->purpose == 0 || in_array($_smarty_tpl->tpl_vars['module']->value,array('ProductView','ProductsView','CartView','OrderView','BrowsedView','CompareView','WishlistView'))) {?>
			<?php $_smarty_tpl->_subTemplateRender('file:mcatalog.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->show_brands)) {?>
			<ul class="dropdown-menu svg"> <li <?php if (isset($_smarty_tpl->tpl_vars['page']->value->url) && $_smarty_tpl->tpl_vars['page']->value->url == "brands") {?>class="selected"<?php }?>> <svg class="compareempty" viewBox="0 0 24 24"><use xlink:href='#brands' /></svg> <a href="brands" title="Бренды">Бренды</a> </li> </ul>
			<?php }?>
		<?php } elseif ($_smarty_tpl->tpl_vars['settings']->value->purpose == 1) {?>
			<?php $_smarty_tpl->_subTemplateRender('file:mservicescat.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['menus']->value[17]->enabled) {?>
		<ul class="dropdown-menu svg"> <li <?php if (isset($_smarty_tpl->tpl_vars['page']->value->url) && $_smarty_tpl->tpl_vars['page']->value->url == "m-info") {?>class="selected"<?php }?>> <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M0 0h24v24H0z" fill="none"/> <path d="M11 17h2v-6h-2v6zm1-15C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM11 9h2V7h-2v2z"/> </svg> <a href="m-info" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menus']->value[17]->name, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menus']->value[17]->name, ENT_QUOTES, 'UTF-8', true);?>
</a> </li> </ul>
		<?php }?>
		<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_pages'][0], array( array('var'=>"pag",'menu_id'=>1),$_smarty_tpl ) );?>

		<?php if ($_smarty_tpl->tpl_vars['pag']->value) {?>
			<ul class="dropdown-menu svg">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pag']->value, 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
?>
					<li <?php if (isset($_smarty_tpl->tpl_vars['page']->value->id) && $_smarty_tpl->tpl_vars['page']->value->id == $_smarty_tpl->tpl_vars['p']->value->id) {?>class="selected"<?php }?>> <svg class="nophoto"><use xlink:href='#arrow_tool' /></svg> <a href="<?php echo $_smarty_tpl->tpl_vars['p']->value->url;?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value->name, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a> </li>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</ul>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['settings']->value->purpose == 0 || in_array($_smarty_tpl->tpl_vars['module']->value,array('ProductView','ProductsView','CartView','OrderView','BrowsedView','CompareView','WishlistView'))) {?>
		<ul class="dropdown-menu svg"> <li> <svg class="nophoto"><use xlink:href='#arrow_tool' /></svg> <a href="wishlist" title="Избранное">Избранное</a> </li> <li> <svg class="nophoto"><use xlink:href='#arrow_tool' /></svg> <a href="compare" title="Сравнение">Сравнение</a> </li> <li> <svg class="nophoto"><use xlink:href='#arrow_tool' /></svg> <a href="browsed" title="Просмотренные товары">Просмотренные товары</a> </li> </ul>
		<?php }?>
		<ul class="dropdown-menu svg usermenu"> <li> <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/> <path d="M0 0h24v24H0z" fill="none"/> </svg> <a href="user" title="Личный кабинет">Личный кабинет</a> </li>
			<?php if ($_smarty_tpl->tpl_vars['settings']->value->purpose == 0 || in_array($_smarty_tpl->tpl_vars['module']->value,array('ProductView','ProductsView','CartView','OrderView','BrowsedView','CompareView','WishlistView'))) {?>
			<li> <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/> <path d="M0 0h24v24H0z" fill="none"/> </svg> <a href="cart" title="Корзина">Корзина</a> </li>
			<?php }?>
		</ul> </div> </div> <div id="catoverlay" style="display:none;" onclick="hideShowOverlay(this);return false;"> </div> <!-- incl. toolbar @ --><?php }
}
