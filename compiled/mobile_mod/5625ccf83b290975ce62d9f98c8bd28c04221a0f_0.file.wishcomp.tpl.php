<?php
/* Smarty version 3.1.33, created on 2020-11-02 12:29:26
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/wishcomp.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5f9ffba6292a53_46309576',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5625ccf83b290975ce62d9f98c8bd28c04221a0f' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/wishcomp.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f9ffba6292a53_46309576 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="wishcomp"> <div class="compare addcompare">
		<?php ob_start();
echo $_smarty_tpl->tpl_vars['product']->value->id;
$_prefixVariable2 = ob_get_clean();
if (!empty($_smarty_tpl->tpl_vars['compare_informer']->value->items_id[$_prefixVariable2])) {?>
			<span class="gocompare activewc" onclick="window.location='/compare'"> <svg><use xlink:href='#activec' /></svg> </span>
		<?php } else { ?>
			<span style="display:none;" class="gocompare activewc" onclick="window.location='/compare'"> <svg><use xlink:href='#activec' /></svg> </span> <svg class="basewc" data-wish="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
"><use xlink:href='#basec' /></svg>
		<?php }?>
	</div> <div class="wishprod"> <div class="wishlist towish">
			<?php if (!empty($_smarty_tpl->tpl_vars['wished_products']->value) && in_array($_smarty_tpl->tpl_vars['product']->value->id,$_smarty_tpl->tpl_vars['wished_products']->value)) {?>
				<span onclick="window.location='/wishlist'" class="inwish activewc"> <svg><use xlink:href='#activew' /></svg> </span>
			<?php } else { ?>
				<span style="display:none;" onclick="window.location='/wishlist'" class="inwish activewc"> <svg><use xlink:href='#activew' /></svg> </span> <svg class="basewc" data-wish="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
"><use xlink:href='#basew' /></svg>
			<?php }?>
		</div> </div> </div><?php }
}
