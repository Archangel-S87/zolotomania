<?php
/* Smarty version 3.1.33, created on 2020-11-02 12:14:11
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/slides_mob.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5f9ff813f00ee9_57239600',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f94ec69f24fbab73293197818f5e07e8d0548dd' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/slides_mob.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f9ff813f00ee9_57239600 (Smarty_Internal_Template $_smarty_tpl) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_slidesm'][0], array( array('var'=>'slidem'),$_smarty_tpl ) );?>

<?php if (!empty($_smarty_tpl->tpl_vars['slidem']->value)) {?>
	<?php echo '<script'; ?>
 src="androidcore/slider.js"><?php echo '</script'; ?>
> <div id="slider" class="swipe"> <div class="swipe-wrap">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slidem']->value, 's');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['s']->value) {
?>
				<?php if (!empty($_smarty_tpl->tpl_vars['s']->value->image)) {?>
					<div> <img loading="lazy" <?php if ($_smarty_tpl->tpl_vars['s']->value->url) {?>onclick="window.location='<?php echo $_smarty_tpl->tpl_vars['s']->value->url;?>
'"<?php }?> src="<?php echo $_smarty_tpl->tpl_vars['s']->value->image;?>
" alt="<?php if (!empty($_smarty_tpl->tpl_vars['s']->value->name)) {
echo $_smarty_tpl->tpl_vars['s']->value->name;
}?>" <?php if (!empty($_smarty_tpl->tpl_vars['s']->value->name)) {?>title="<?php echo $_smarty_tpl->tpl_vars['s']->value->name;?>
"<?php }?> /> </div>
				<?php }?>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</div> </div> <div class="sliderdots"> <div class="dotswrapper">
			<?php $_smarty_tpl->_assignInScope('cslidem', 0);?>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slidem']->value, 's');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['s']->value) {
?>
				<?php if (!empty($_smarty_tpl->tpl_vars['s']->value->image)) {?>
					<div id="<?php echo $_smarty_tpl->tpl_vars['cslidem']->value;?>
" class="dot<?php if ($_smarty_tpl->tpl_vars['cslidem']->value == 0) {?> active<?php }?>"></div>
					<?php $_smarty_tpl->_assignInScope('cslidem', $_smarty_tpl->tpl_vars['cslidem']->value+1);?>
				<?php }?>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</div> </div>
<?php }
}
}
