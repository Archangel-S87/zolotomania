<?php
/* Smarty version 3.1.33, created on 2020-11-12 15:56:38
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/toolbar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fad5b36e65266_66937393',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f5e6e309af140c0975cc45764139031e394a3fec' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/toolbar.tpl',
      1 => 1605196554,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:wishlist_informer.tpl' => 1,
    'file:cart_informer.tpl' => 1,
  ),
),false)) {
function content_5fad5b36e65266_66937393 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- incl. toolbar --> <div id="menutop"> <div id="menutopbody"> <div class="row"> <div id="logo"> <img onclick="window.location='/'" src="files/logo/logo.png?v=<?php echo filemtime('files/logo/logo.png');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->site_name, ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->site_name, ENT_QUOTES, 'UTF-8', true);?>
" /> </div>
						<a href="tel:8800123-45-67" class="topphone">8 (800) 123-45-67</a> </div> <div class="row">
			<?php if ($_smarty_tpl->tpl_vars['settings']->value->purpose == 0 || in_array($_smarty_tpl->tpl_vars['module']->value,array('ProductView','ProductsView','CartView','OrderView','BrowsedView','CompareView','WishlistView'))) {?>

				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_wishlist_products'][0], array( array('var'=>'wished_products'),$_smarty_tpl ) );?>

								<div id="wishlist" title="Избранное" onclick="window.location='/wishlist'">
					<?php $_smarty_tpl->_subTemplateRender('file:wishlist_informer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
				</div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['settings']->value->purpose == 0 || in_array($_smarty_tpl->tpl_vars['module']->value,array('CartView','OrderView','ProductView','ProductsView'))) {?>
				<div id="cart_informer" onclick="window.location='cart'">
					<?php $_smarty_tpl->_subTemplateRender('file:cart_informer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
				</div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['user']->value) {?>
				<span class="username" onclick="window.location='/user'">личный кабинет</span> <span class="username" onclick="window.location='/responses'">отзывы</span> <span class="username" onclick="window.location='/user/logout'">выйти</span>
			<?php } else { ?>
				<span class="username" onclick="window.location='/user/login'">Вход</span> <span class="username" onclick="window.location='/responses'">отзывы</span> <span class="username" onclick="window.location='/user/register'">Регистрация</span>
			<?php }?>
		</div> </div> </div> <div id="catoverlay" style="display:none;" onclick="hideShowOverlay(this);return false;"> </div> <!-- incl. toolbar @ --><?php }
}
