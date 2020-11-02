<?php
/* Smarty version 3.1.33, created on 2020-11-02 12:14:11
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5f9ff813ebc994_49624377',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '47e38e23a320e1335f0c7f2021cb7d1b24cba515' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/main.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:slides_mob.tpl' => 1,
    'file:mblog.tpl' => 1,
  ),
),false)) {
function content_5f9ff813ebc994_49624377 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'categories_treemain' => 
  array (
    'compiled_filepath' => '/Applications/MAMP/htdocs/zolotomania/compiled/mobile_mod/47e38e23a320e1335f0c7f2021cb7d1b24cba515_0.file.main.tpl.php',
    'uid' => '47e38e23a320e1335f0c7f2021cb7d1b24cba515',
    'call_name' => 'smarty_template_function_categories_treemain_15156828015f9ff813dde551_17932883',
  ),
  'services_categories_treemain' => 
  array (
    'compiled_filepath' => '/Applications/MAMP/htdocs/zolotomania/compiled/mobile_mod/47e38e23a320e1335f0c7f2021cb7d1b24cba515_0.file.main.tpl.php',
    'uid' => '47e38e23a320e1335f0c7f2021cb7d1b24cba515',
    'call_name' => 'smarty_template_function_services_categories_treemain_15156828015f9ff813dde551_17932883',
  ),
));
$_smarty_tpl->_assignInScope('wrapper', 'index.tpl' ,false ,8);?>

<?php $_smarty_tpl->_assignInScope('canonical', '' ,false ,8);?>

<?php $_smarty_tpl->_subTemplateRender('file:slides_mob.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<?php if ($_smarty_tpl->tpl_vars['settings']->value->purpose == 0) {?>
		
		<?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'categories_treemain', array('categories'=>$_smarty_tpl->tpl_vars['categories']->value), true);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['settings']->value->purpose == 1) {?>
		
		<?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'services_categories_treemain', array('services_categories'=>$_smarty_tpl->tpl_vars['services_categories']->value), true);?>
	
	<?php }?>

<?php if ($_smarty_tpl->tpl_vars['page']->value->body) {?>
	<div class="main-text"> <div class="top cutouter" style="max-height:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->cutmob, ENT_QUOTES, 'UTF-8', true);?>
px;"> <div class="disappear"></div> <div class="cutinner"> <h1><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value->header, ENT_QUOTES, 'UTF-8', true);?>
</h1>
			  	<?php echo $_smarty_tpl->tpl_vars['page']->value->body;?>

			</div> </div> <div class="top cutmore" style="display:none;">Развернуть...</div> </div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['settings']->value->hideblog == 1) {?>
	<?php $_smarty_tpl->_assignInScope('news', 3);?>
	<?php $_smarty_tpl->_subTemplateRender('file:mblog.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
/* smarty_template_function_categories_treemain_15156828015f9ff813dde551_17932883 */
if (!function_exists('smarty_template_function_categories_treemain_15156828015f9ff813dde551_17932883')) {
function smarty_template_function_categories_treemain_15156828015f9ff813dde551_17932883(Smarty_Internal_Template $_smarty_tpl,$params) {
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

			<?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>
				<div class="maincatalog">Каталог</div> <ul class="category_products separator" style="margin-bottom:10px;margin-top:0;">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'c');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
						<?php if ($_smarty_tpl->tpl_vars['c']->value->visible) {?>
							<li class="product" onClick="window.location='/catalog/<?php echo $_smarty_tpl->tpl_vars['c']->value->url;?>
'"> <div class="image">
									<?php if ($_smarty_tpl->tpl_vars['c']->value->image) {?>
										<img alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" src="<?php echo $_smarty_tpl->tpl_vars['config']->value->categories_images_dir;
echo $_smarty_tpl->tpl_vars['c']->value->image;?>
" />
									<?php } else { ?>
										<svg class="nophoto"><use xlink:href='#folder' /></svg>
									<?php }?>
								</div> <div class="product_info"> <h3><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</h3> </div> </li>
						<?php }?>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					<?php if (!empty($_smarty_tpl->tpl_vars['settings']->value->show_brands)) {?>
							<li class="product svg_brands" onClick="window.location='/brands'"> <div class="image"> <svg viewBox="0 0 24 24"><use xlink:href='#brands' /></svg> </div> <div class="product_info"> <h3>Бренды</h3> </div> </li>
					<?php }?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_products'][0], array( array('var'=>'discounted_products','discounted'=>1,'limit'=>3),$_smarty_tpl ) );?>

					<?php if (!empty($_smarty_tpl->tpl_vars['discounted_products']->value) && count($_smarty_tpl->tpl_vars['discounted_products']->value) > 2) {?>
							<li class="product svg_lowprice" onClick="window.location='/discounted'"> <div class="image"> <svg class="lowprice" viewBox="0 0 24 24"><use xlink:href='#lowprice' /></svg> </div> <div class="product_info"> <h3>Скидки</h3> </div> </li>
					<?php }?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_products'][0], array( array('var'=>'featured_products','featured'=>1,'limit'=>3),$_smarty_tpl ) );?>

					<?php if (!empty($_smarty_tpl->tpl_vars['featured_products']->value) && count($_smarty_tpl->tpl_vars['featured_products']->value) > 2) {?>
							<li class="product svg_hit" onClick="window.location='/hits'"> <div class="image"> <svg class="hit" viewBox="0 0 24 24"><use xlink:href='#hit' /></svg> </div> <div class="product_info"> <h3>Лидеры продаж</h3> </div> </li>
					<?php }?>
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_products'][0], array( array('var'=>'is_new_products','is_new'=>1,'limit'=>3),$_smarty_tpl ) );?>

					<?php if (!empty($_smarty_tpl->tpl_vars['is_new_products']->value) && count($_smarty_tpl->tpl_vars['is_new_products']->value) > 2) {?>
							<li class="product svg_new" onClick="window.location='/new'"> <div class="image"> <svg class="new" viewBox="0 0 24 24"><use xlink:href='#new' /></svg> </div> <div class="product_info"> <h3>Новинки</h3> </div> </li>
					<?php }?>
				</ul>
			<?php }?>
		<?php
}}
/*/ smarty_template_function_categories_treemain_15156828015f9ff813dde551_17932883 */
/* smarty_template_function_services_categories_treemain_15156828015f9ff813dde551_17932883 */
if (!function_exists('smarty_template_function_services_categories_treemain_15156828015f9ff813dde551_17932883')) {
function smarty_template_function_services_categories_treemain_15156828015f9ff813dde551_17932883(Smarty_Internal_Template $_smarty_tpl,$params) {
$params = array_merge(array('level'=>1), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

				<?php if ($_smarty_tpl->tpl_vars['services_categories']->value) {?>
					<div class="maincatalog">Каталог</div> <ul class="category_products separator" style="margin-bottom:10px;margin-top:0px;">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['services_categories']->value, 'ac2');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ac2']->value) {
?>
							<?php if ($_smarty_tpl->tpl_vars['ac2']->value->visible) {?>
								<li class="product" onClick="window.location='/services/<?php echo $_smarty_tpl->tpl_vars['ac2']->value->url;?>
'"> <div class="image">
									<?php if ($_smarty_tpl->tpl_vars['ac2']->value->image) {?>
										<img alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ac2']->value->menu, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ac2']->value->menu, ENT_QUOTES, 'UTF-8', true);?>
" src="<?php echo $_smarty_tpl->tpl_vars['config']->value->services_categories_images_dir;
echo $_smarty_tpl->tpl_vars['ac2']->value->image;?>
" />
									<?php } else { ?>
										<svg class="nophoto"><use xlink:href='#folder' /></svg>
									<?php }?>
									</div> <div class="product_info"> <h3><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ac2']->value->menu, ENT_QUOTES, 'UTF-8', true);?>
</h3> </div> </li>
							<?php }?>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</ul>
				<?php }?>
		<?php
}}
/*/ smarty_template_function_services_categories_treemain_15156828015f9ff813dde551_17932883 */
}
