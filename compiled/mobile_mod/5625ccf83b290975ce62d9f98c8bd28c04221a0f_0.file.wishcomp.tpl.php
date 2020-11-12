<?php
/* Smarty version 3.1.33, created on 2020-11-12 16:07:27
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/wishcomp.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fad5dbf009f45_36959275',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5625ccf83b290975ce62d9f98c8bd28c04221a0f' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/wishcomp.tpl',
      1 => 1605196848,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fad5dbf009f45_36959275 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="wishcomp"> <div class="wishprod"> <div class="wishlist towish">
			<?php if (!empty($_smarty_tpl->tpl_vars['wished_products']->value) && in_array($_smarty_tpl->tpl_vars['product']->value->id,$_smarty_tpl->tpl_vars['wished_products']->value)) {?>
			<?php } else { ?>
				<span class="basewc buttonred" data-wish="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
">Подумаю</span>
			<?php }?>
		</div> </div> </div><?php }
}
