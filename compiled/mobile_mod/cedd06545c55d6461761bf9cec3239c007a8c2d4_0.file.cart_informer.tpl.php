<?php
/* Smarty version 3.1.33, created on 2020-11-02 18:16:53
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/cart_informer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fa04d152f5639_94915838',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cedd06545c55d6461761bf9cec3239c007a8c2d4' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/cart_informer.tpl',
      1 => 1604341011,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fa04d152f5639_94915838 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- incl. cart_informer --> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 63.51 56.29"><g id="Слой_2" data-name="Слой 2"><g id="Слой_1-2" data-name="Слой 1"><path class="cls-1" fill="#4f4f51" d="M63.51,13.49H45A8,8,0,0,0,33.4,2.35a7.79,7.79,0,0,0-1.64,2.9,7.93,7.93,0,0,0-1.65-2.9A8,8,0,0,0,18.55,13.49H0V28.15H3.72V56.29H59.79V28.15h3.72ZM36.1,17.21v7.22H27.41V17.21Zm0,10.94V52.56H27.41V28.15ZM36,5a4.31,4.31,0,0,1,6.09,6.09c-1,1-4.69,1.83-8.28,2.23C34.41,8.69,35.33,5.68,36,5ZM21.39,5a4.31,4.31,0,0,1,6.09,0c.7.7,1.62,3.71,2.19,8.32-3.59-.4-7.3-1.25-8.28-2.23a4.31,4.31,0,0,1,0-6.09ZM3.72,17.21h20v7.22h-20ZM7.44,28.15H23.69V52.56H7.44ZM56.07,52.56H39.82V28.15H56.07Zm3.72-28.13h-20V17.21h20Z"/></g></g></svg>
<?php if (!empty($_smarty_tpl->tpl_vars['cart']->value) && $_smarty_tpl->tpl_vars['cart']->value->total_products > 0) {?><div class="badge" onclick="window.location='/cart'"><?php echo count($_smarty_tpl->tpl_vars['cart']->value->purchases);?>
</div><?php }
if (!empty($_smarty_tpl->tpl_vars['mobile_app']->value)) {?>
	<?php echo '<script'; ?>
>
		try { 
			Android.sendTotalProducts("<?php echo count($_smarty_tpl->tpl_vars['cart']->value->purchases);?>
");
		} catch(e) {};
		try { 
			window.webkit.messageHandlers.cart.postMessage("<?php echo count($_smarty_tpl->tpl_vars['cart']->value->purchases);?>
");
		} catch(e) {};
	<?php echo '</script'; ?>
>
<?php }?>
<!-- incl. cart_informer @ --><?php }
}
