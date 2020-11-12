<?php
/* Smarty version 3.1.33, created on 2020-11-02 20:03:57
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/services.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fa0662d374138_12147794',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ab875cf7f95bc8f8dbe7e29234f9ada49af132d' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/services.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fa0662d374138_12147794 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'services_categories_tree2' => 
  array (
    'compiled_filepath' => '/Applications/MAMP/htdocs/zolotomania/compiled/mobile_mod/9ab875cf7f95bc8f8dbe7e29234f9ada49af132d_0.file.services.tpl.php',
    'uid' => '9ab875cf7f95bc8f8dbe7e29234f9ada49af132d',
    'call_name' => 'smarty_template_function_services_categories_tree2_11469660345fa0662d26b509_28363122',
  ),
));
if (!empty($_smarty_tpl->tpl_vars['category']->value->url)) {?>
	<?php ob_start();
if (!empty($_smarty_tpl->tpl_vars['current_page_num']->value) && $_smarty_tpl->tpl_vars['current_page_num']->value > 1) {
echo "?page=";
echo (string)$_smarty_tpl->tpl_vars['current_page_num']->value;
}
$_prefixVariable1=ob_get_clean();
$_smarty_tpl->_assignInScope('canonical', "/services/".((string)$_smarty_tpl->tpl_vars['category']->value->url).$_prefixVariable1 ,false ,8);
} elseif (!empty($_smarty_tpl->tpl_vars['keyword']->value)) {?>
	<?php ob_start();
echo htmlspecialchars($_smarty_tpl->tpl_vars['keyword']->value, ENT_QUOTES, 'UTF-8', true);
$_prefixVariable2=ob_get_clean();
$_smarty_tpl->_assignInScope('canonical', "/services?keyword=".$_prefixVariable2 ,false ,8);
} else { ?>
	<?php ob_start();
if (!empty($_smarty_tpl->tpl_vars['current_page_num']->value) && $_smarty_tpl->tpl_vars['current_page_num']->value > 1) {
echo "?page=";
echo (string)$_smarty_tpl->tpl_vars['current_page_num']->value;
}
$_prefixVariable3=ob_get_clean();
$_smarty_tpl->_assignInScope('canonical', "/services".$_prefixVariable3 ,false ,8);
}?>

<?php if (!empty($_smarty_tpl->tpl_vars['keyword']->value)) {?>
	<?php $_smarty_tpl->_assignInScope('meta_title', $_smarty_tpl->tpl_vars['keyword']->value ,false ,8);?>
	<?php $_smarty_tpl->_assignInScope('meta_description', $_smarty_tpl->tpl_vars['keyword']->value ,false ,8);?>
	<?php $_smarty_tpl->_assignInScope('meta_keywords', $_smarty_tpl->tpl_vars['keyword']->value ,false ,8);?>

	<?php if ($_smarty_tpl->tpl_vars['serviceskey']->value) {?>
		<ul class="category_products separator">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['serviceskey']->value, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value) {
?>
					<li class="product" onClick="window.location='services/<?php echo $_smarty_tpl->tpl_vars['key']->value->url;?>
'" style="cursor:pointer;"> <div class="image">
							<?php if ($_smarty_tpl->tpl_vars['key']->value->image) {?>
								<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value->services_categories_images_dir;
echo $_smarty_tpl->tpl_vars['key']->value->image;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['key']->value->menu;?>
" title="<?php echo $_smarty_tpl->tpl_vars['key']->value->menu;?>
" />
							<?php } else { ?>
								<svg class="nophoto"><use xlink:href='#folder' /></svg>
							<?php }?>
						</div> <div class="product_info"> <h3><?php echo $_smarty_tpl->tpl_vars['key']->value->menu;?>
</h3> </div> </li>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</ul>
	<?php } else { ?>
		<div class="blog-pg">
			Услуг не найдено
		</div>
	<?php }
} else { ?>
	<?php if ($_smarty_tpl->tpl_vars['page']->value) {?>
		<?php $_smarty_tpl->_assignInScope('meta_title', htmlspecialchars($_smarty_tpl->tpl_vars['page']->value->meta_title, ENT_QUOTES, 'UTF-8', true) ,false ,8);?>
		<?php $_smarty_tpl->_assignInScope('meta_description', htmlspecialchars($_smarty_tpl->tpl_vars['page']->value->meta_description, ENT_QUOTES, 'UTF-8', true) ,false ,8);?>
		<?php $_smarty_tpl->_assignInScope('meta_keywords', htmlspecialchars($_smarty_tpl->tpl_vars['page']->value->meta_keywords, ENT_QUOTES, 'UTF-8', true) ,false ,8);?>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['page']->value && $_smarty_tpl->tpl_vars['page']->value->url == 'services') {?>
					
			<?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'services_categories_tree2', array('services_categories'=>$_smarty_tpl->tpl_vars['services_categories']->value), true);?>

			<?php }?>	

	<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->subcategories)) {?>
			<ul class="category_products separator">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category']->value->subcategories, 'c', false, NULL, 'cats', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
					<?php if ($_smarty_tpl->tpl_vars['c']->value->visible) {?>
						<li class="product" onClick="window.location='services/<?php echo $_smarty_tpl->tpl_vars['c']->value->url;?>
'"> <div class="image">
							<?php if ($_smarty_tpl->tpl_vars['c']->value->image) {?>
								<img alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->menu, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->menu, ENT_QUOTES, 'UTF-8', true);?>
" src="<?php echo $_smarty_tpl->tpl_vars['config']->value->services_categories_images_dir;
echo $_smarty_tpl->tpl_vars['c']->value->image;?>
" />
							<?php } else { ?>
								<svg class="nophoto"><use xlink:href='#no_photo' /></svg>
							<?php }?>
							</div> <div class="product_info"> <h3><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->menu, ENT_QUOTES, 'UTF-8', true);?>
</h3> </div> </li>
					<?php }?>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</ul>
	<?php }?>

	<?php if (!empty($_smarty_tpl->tpl_vars['page']->value->body) || !empty($_smarty_tpl->tpl_vars['category']->value->description)) {?>
			<div class="blog-pg">	
				<?php if (!empty($_smarty_tpl->tpl_vars['page']->value->body)) {
echo $_smarty_tpl->tpl_vars['page']->value->body;
}?>
				<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->description)) {
echo $_smarty_tpl->tpl_vars['category']->value->description;
}?>
			</div>
	<?php }?>

	<?php if (!empty($_smarty_tpl->tpl_vars['service']->value->images)) {?>
		<ul id="gallerypic" class="tiny_products">	
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['service']->value->images, 'image', false, 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['image']->value) {
?>
				<li class="product"><div class="image"> <a rel="gallery" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'resize' ][ 0 ], array( $_smarty_tpl->tpl_vars['image']->value->filename,800,600,'w',$_smarty_tpl->tpl_vars['config']->value->resized_services_images_dir ));?>
" class="swipebox" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);?>
"> <img alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'resize' ][ 0 ], array( $_smarty_tpl->tpl_vars['image']->value->filename,400,400,false,$_smarty_tpl->tpl_vars['config']->value->resized_services_images_dir ));?>
" /></a></div> </li>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</ul>
	<?php }?>

<?php }
}
/* smarty_template_function_services_categories_tree2_11469660345fa0662d26b509_28363122 */
if (!function_exists('smarty_template_function_services_categories_tree2_11469660345fa0662d26b509_28363122')) {
function smarty_template_function_services_categories_tree2_11469660345fa0662d26b509_28363122(Smarty_Internal_Template $_smarty_tpl,$params) {
$params = array_merge(array('level'=>1), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

				<?php if ($_smarty_tpl->tpl_vars['services_categories']->value) {?>
					<ul class="category_products separator">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['services_categories']->value, 'ac2');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ac2']->value) {
?>
							<?php if ($_smarty_tpl->tpl_vars['ac2']->value->visible) {?>
								<li class="product" onClick="window.location='services/<?php echo $_smarty_tpl->tpl_vars['ac2']->value->url;?>
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
/*/ smarty_template_function_services_categories_tree2_11469660345fa0662d26b509_28363122 */
}
