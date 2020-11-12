<?php
/* Smarty version 3.1.33, created on 2020-11-02 20:08:34
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/mservicescat.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fa067425d2977_69856424',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f608a2e8090fb609b19f16f668560b84121b022e' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/mservicescat.tpl',
      1 => 1604347713,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fa067425d2977_69856424 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'services_categories_tree' => 
  array (
    'compiled_filepath' => '/Applications/MAMP/htdocs/zolotomania/compiled/mobile_mod/f608a2e8090fb609b19f16f668560b84121b022e_0.file.mservicescat.tpl.php',
    'uid' => 'f608a2e8090fb609b19f16f668560b84121b022e',
    'call_name' => 'smarty_template_function_services_categories_tree_17089568085fa06742532265_52105216',
  ),
));
?><!-- incl. mservicescat --> <div class="box"> <div class="box-content"> <div class="box-category">
			
			<?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'services_categories_tree', array('services_categories'=>$_smarty_tpl->tpl_vars['services_categories']->value), true);?>
	
		</div> </div> </div> <!-- incl. mservicescat @ --><?php }
/* smarty_template_function_services_categories_tree_17089568085fa06742532265_52105216 */
if (!function_exists('smarty_template_function_services_categories_tree_17089568085fa06742532265_52105216')) {
function smarty_template_function_services_categories_tree_17089568085fa06742532265_52105216(Smarty_Internal_Template $_smarty_tpl,$params) {
$params = array_merge(array('level'=>1), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

			<?php if ($_smarty_tpl->tpl_vars['services_categories']->value) {?>
				<ul>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['services_categories']->value, 'ac');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ac']->value) {
?>
						<?php if ($_smarty_tpl->tpl_vars['ac']->value->visible) {?>
						<li> <a href="services/<?php echo $_smarty_tpl->tpl_vars['ac']->value->url;?>
" data-servicescategory="<?php echo $_smarty_tpl->tpl_vars['ac']->value->id;?>
"<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->id) && in_array($_smarty_tpl->tpl_vars['category']->value->id,$_smarty_tpl->tpl_vars['ac']->value->children)) {?> class="filter-active"<?php }?> title="<?php echo $_smarty_tpl->tpl_vars['ac']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['ac']->value->menu;
if (!empty($_smarty_tpl->tpl_vars['ac']->value->subcategories)) {
$_smarty_tpl->_assignInScope('vis', 0);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ac']->value->subcategories, 'sc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sc']->value) {
if ($_smarty_tpl->tpl_vars['sc']->value->visible) {
$_smarty_tpl->_assignInScope('vis', $_smarty_tpl->tpl_vars['vis']->value+1);
}
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['vis']->value > 0) {?><span<?php if ($_smarty_tpl->tpl_vars['level']->value > 1) {?> style="font-size: 18px;"<?php }?>>+</span><?php }
}?></a>
							<?php if (!empty($_smarty_tpl->tpl_vars['ac']->value->subcategories)) {?>
								<?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'services_categories_tree', array('services_categories'=>$_smarty_tpl->tpl_vars['ac']->value->subcategories,'level'=>$_smarty_tpl->tpl_vars['level']->value+1), true);?>

							<?php }?>
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
/*/ smarty_template_function_services_categories_tree_17089568085fa06742532265_52105216 */
}
