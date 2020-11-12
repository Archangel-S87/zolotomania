<?php
/* Smarty version 3.1.33, created on 2020-11-12 13:12:04
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/mcatalog.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fad34a4d43d84_82443526',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b8791f09b2e9cdf96ebbe6bc2c99f06bb60fcd9e' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/mcatalog.tpl',
      1 => 1605186577,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fad34a4d43d84_82443526 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'categories_tree' => 
  array (
    'compiled_filepath' => '/Applications/MAMP/htdocs/zolotomania/compiled/mobile_mod/b8791f09b2e9cdf96ebbe6bc2c99f06bb60fcd9e_0.file.mcatalog.tpl.php',
    'uid' => 'b8791f09b2e9cdf96ebbe6bc2c99f06bb60fcd9e',
    'call_name' => 'smarty_template_function_categories_tree_10827256845fad34a4c73356_99105431',
  ),
));
?><!-- incl. mcatalog --> <div class="box" id="catalog_menu"> <div class="box-content"> <div class="box-category">
			
			<?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'categories_tree', array('categories'=>$_smarty_tpl->tpl_vars['categories']->value), true);?>

		</div> </div> </div> <!-- incl. mcatalog @ --><?php }
/* smarty_template_function_categories_tree_10827256845fad34a4c73356_99105431 */
if (!function_exists('smarty_template_function_categories_tree_10827256845fad34a4c73356_99105431')) {
function smarty_template_function_categories_tree_10827256845fad34a4c73356_99105431(Smarty_Internal_Template $_smarty_tpl,$params) {
$params = array_merge(array('level'=>1), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

				<?php if (!empty($_smarty_tpl->tpl_vars['categories']->value)) {?>
					<ul>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'c');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
							<?php if ($_smarty_tpl->tpl_vars['c']->value->visible) {?>
								<li> <a title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" href="catalog/<?php echo $_smarty_tpl->tpl_vars['c']->value->url;?>
" data-category="<?php echo $_smarty_tpl->tpl_vars['c']->value->id;?>
" 
								<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->id) && in_array($_smarty_tpl->tpl_vars['category']->value->id,$_smarty_tpl->tpl_vars['c']->value->children)) {?>class="filter-active"<?php }?>
								><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->name, ENT_QUOTES, 'UTF-8', true);?>

																</a>
																	</li>
							<?php }?>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</ul>
				<?php }?>
			<?php
}}
/*/ smarty_template_function_categories_tree_10827256845fad34a4c73356_99105431 */
}
