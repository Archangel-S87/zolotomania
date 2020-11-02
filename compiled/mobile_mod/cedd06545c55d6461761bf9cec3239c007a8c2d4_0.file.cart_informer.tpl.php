<?php
/* Smarty version 3.1.33, created on 2020-11-02 12:14:12
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/cart_informer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5f9ff8145bf213_21662982',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cedd06545c55d6461761bf9cec3239c007a8c2d4' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/cart_informer.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f9ff8145bf213_21662982 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- incl. cart_informer --> <svg fill="#FFFFFF" height="24" viewBox="0 0 24 20" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M0 0h24v24H0zm18.31 6l-2.76 5z" fill="none"/> <path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-9.83-3.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4h-.01l-1.1 2-2.76 5H8.53l-.13-.27L6.16 6l-.95-2-.94-2H1v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.13 0-.25-.11-.25-.25z"/> </svg>
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
