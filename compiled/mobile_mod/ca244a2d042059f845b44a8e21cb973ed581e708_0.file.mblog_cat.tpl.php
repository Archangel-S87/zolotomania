<?php
/* Smarty version 3.1.33, created on 2020-11-02 19:55:21
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/mblog_cat.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fa06429576e50_96912128',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ca244a2d042059f845b44a8e21cb973ed581e708' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/mblog_cat.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fa06429576e50_96912128 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- incl. mblog_cat --> <div class="box"> <div class="box-heading">Разделы блога</div> <div class="box-content"> <div class="box-category" role="navigation"> <ul>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['blog_categories']->value, 'bc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['bc']->value) {
?>
				<?php if ($_smarty_tpl->tpl_vars['bc']->value->visible) {?>
				<li> <a href="sections/<?php echo $_smarty_tpl->tpl_vars['bc']->value->url;?>
" data-blogcategory="<?php echo $_smarty_tpl->tpl_vars['bc']->value->id;?>
"<?php if (isset($_smarty_tpl->tpl_vars['category']->value->id) && $_smarty_tpl->tpl_vars['category']->value->id == $_smarty_tpl->tpl_vars['bc']->value->id) {?> class="filter-active"<?php }?> title="<?php echo $_smarty_tpl->tpl_vars['bc']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['bc']->value->name;?>
</a> </li>
				<?php }?>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</ul> </div> </div> </div> <!-- incl. mblog_cat @--><?php }
}
