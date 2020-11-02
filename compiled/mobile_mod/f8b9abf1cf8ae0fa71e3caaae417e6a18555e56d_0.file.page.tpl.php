<?php
/* Smarty version 3.1.33, created on 2020-11-02 13:09:36
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fa00510c3a668_22712117',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f8b9abf1cf8ae0fa71e3caaae417e6a18555e56d' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/page.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:minfo.tpl' => 1,
  ),
),false)) {
function content_5fa00510c3a668_22712117 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'categories_treecat' => 
  array (
    'compiled_filepath' => '/Applications/MAMP/htdocs/zolotomania/compiled/mobile_mod/f8b9abf1cf8ae0fa71e3caaae417e6a18555e56d_0.file.page.tpl.php',
    'uid' => 'f8b9abf1cf8ae0fa71e3caaae417e6a18555e56d',
    'call_name' => 'smarty_template_function_categories_treecat_13331096465fa00510850ee5_11608847',
  ),
  'services_categories_tree2' => 
  array (
    'compiled_filepath' => '/Applications/MAMP/htdocs/zolotomania/compiled/mobile_mod/f8b9abf1cf8ae0fa71e3caaae417e6a18555e56d_0.file.page.tpl.php',
    'uid' => 'f8b9abf1cf8ae0fa71e3caaae417e6a18555e56d',
    'call_name' => 'smarty_template_function_services_categories_tree2_13331096465fa00510850ee5_11608847',
  ),
));
$_smarty_tpl->_assignInScope('canonical', "/".((string)$_smarty_tpl->tpl_vars['page']->value->url) ,false ,8);?>

<?php if ($_smarty_tpl->tpl_vars['page']->value->url == 'catalog' || $_smarty_tpl->tpl_vars['page']->value->url == '404') {?>
		<?php if ($_smarty_tpl->tpl_vars['settings']->value->purpose == 0 || $_smarty_tpl->tpl_vars['page']->value->url == 'catalog') {?>
		
		<?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'categories_treecat', array('categories'=>$_smarty_tpl->tpl_vars['categories']->value), true);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['settings']->value->purpose == 1) {?>
		
		<?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'services_categories_tree2', array('services_categories'=>$_smarty_tpl->tpl_vars['services_categories']->value), true);?>
	
	<?php }?>
	<?php } elseif ($_smarty_tpl->tpl_vars['page']->value->url == 'reviews-archive') {?>
	<div id="comments" class="response_archive" itemprop="description"> <ul role="navigation" class="comment_list">
			<?php $_smarty_tpl->_assignInScope('comments_num', 0);?>
			
			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_comments'][0], array( array('var'=>'last_comments1','type'=>'product'),$_smarty_tpl ) );?>

			<?php if ($_smarty_tpl->tpl_vars['last_comments1']->value) {?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['last_comments1']->value, 'comment');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['comment']->value) {
?>
					<li> <p><b><?php echo $_smarty_tpl->tpl_vars['comment']->value->name;?>
</b> о товаре <a href="products/<?php echo $_smarty_tpl->tpl_vars['comment']->value->url;?>
"><?php echo $_smarty_tpl->tpl_vars['comment']->value->product;?>
</a>:
						&laquo;<?php echo nl2br(htmlspecialchars($_smarty_tpl->tpl_vars['comment']->value->text, ENT_QUOTES, 'UTF-8', true));?>
&raquo;</p>
						<?php if ($_smarty_tpl->tpl_vars['comment']->value->otvet) {?>
							<div class="comment_admint">Администрация:</div> <div class="comment_admin">
								<?php echo $_smarty_tpl->tpl_vars['comment']->value->otvet;?>

							</div>
						<?php }?>
					</li>
					<?php $_smarty_tpl->_assignInScope('comments_num', $_smarty_tpl->tpl_vars['comments_num']->value+1);?>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	        <?php }?>

			<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_comments'][0], array( array('var'=>'last_comments2','type'=>'blog'),$_smarty_tpl ) );?>

			<?php if ($_smarty_tpl->tpl_vars['last_comments2']->value) {?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['last_comments2']->value, 'comment');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['comment']->value) {
?>
					<li> <p><b><?php echo $_smarty_tpl->tpl_vars['comment']->value->name;?>
</b> о записи <a href="blog/<?php echo $_smarty_tpl->tpl_vars['comment']->value->url;?>
"><?php echo $_smarty_tpl->tpl_vars['comment']->value->product;?>
</a>:
						&laquo;<?php echo nl2br(htmlspecialchars($_smarty_tpl->tpl_vars['comment']->value->text, ENT_QUOTES, 'UTF-8', true));?>
&raquo;</p>
						<?php if ($_smarty_tpl->tpl_vars['comment']->value->otvet) {?>
							<div class="comment_admint">Администрация:</div> <div class="comment_admin">
								<?php echo $_smarty_tpl->tpl_vars['comment']->value->otvet;?>

							</div>
						<?php }?>
					</li>
					<?php $_smarty_tpl->_assignInScope('comments_num', $_smarty_tpl->tpl_vars['comments_num']->value+1);?>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	        <?php }?>
		</ul>
		<?php if ($_smarty_tpl->tpl_vars['comments_num']->value > 10) {?>	
			<input type='hidden' id='current_page' /> <input type='hidden' id='show_per_page' /> <div id="page_navigation" class="pagination"></div>
		<?php }?>
	</div>
<?php } elseif ($_smarty_tpl->tpl_vars['page']->value->url == 'brands') {?>
	<div class="brand-pg" itemprop="description">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_brands'][0], array( array('var'=>'all_brands'),$_smarty_tpl ) );?>

        <?php if ($_smarty_tpl->tpl_vars['all_brands']->value) {?>
            <ul class="category_products brands_list">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['all_brands']->value, 'b', false, NULL, 'brands', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['b']->value) {
?>
					<li class="product" style="cursor:pointer;" onClick="window.location='/brands/<?php echo $_smarty_tpl->tpl_vars['b']->value->url;?>
'"> <div class="image">
							<?php if ($_smarty_tpl->tpl_vars['b']->value->image) {?>
								<img alt="<?php echo $_smarty_tpl->tpl_vars['b']->value->name;?>
" title="<?php echo $_smarty_tpl->tpl_vars['b']->value->name;?>
" src="<?php echo $_smarty_tpl->tpl_vars['config']->value->brands_images_dir;
echo $_smarty_tpl->tpl_vars['b']->value->image;?>
" />
														<?php }?>
						</div> <div class="product_info"> <h3 data-brand="<?php echo $_smarty_tpl->tpl_vars['b']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['b']->value->name;?>
</h3> </div> </li>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
        <?php }?>
	</div>	
<?php } elseif ($_smarty_tpl->tpl_vars['page']->value->url == 'm-info') {?>
	<?php $_smarty_tpl->_subTemplateRender('file:minfo.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>

<?php if (!empty($_smarty_tpl->tpl_vars['metadata_page']->value->description) || !empty($_smarty_tpl->tpl_vars['page']->value->body)) {?>
	<div class="page-pg" itemprop="description">
		<?php if (!empty($_smarty_tpl->tpl_vars['metadata_page']->value->description)) {
echo $_smarty_tpl->tpl_vars['metadata_page']->value->description;
} elseif (!empty($_smarty_tpl->tpl_vars['page']->value->body)) {
echo $_smarty_tpl->tpl_vars['page']->value->body;
}?>
	</div>
<?php }
}
/* smarty_template_function_categories_treecat_13331096465fa00510850ee5_11608847 */
if (!function_exists('smarty_template_function_categories_treecat_13331096465fa00510850ee5_11608847')) {
function smarty_template_function_categories_treecat_13331096465fa00510850ee5_11608847(Smarty_Internal_Template $_smarty_tpl,$params) {
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

			<?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>
				<ul class="category_products separator">
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
								</div> <div class="product_info"> <h3><?php echo $_smarty_tpl->tpl_vars['c']->value->name;?>
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
/*/ smarty_template_function_categories_treecat_13331096465fa00510850ee5_11608847 */
/* smarty_template_function_services_categories_tree2_13331096465fa00510850ee5_11608847 */
if (!function_exists('smarty_template_function_services_categories_tree2_13331096465fa00510850ee5_11608847')) {
function smarty_template_function_services_categories_tree2_13331096465fa00510850ee5_11608847(Smarty_Internal_Template $_smarty_tpl,$params) {
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
								<li class="product" onClick="window.location='/services/<?php echo $_smarty_tpl->tpl_vars['ac2']->value->url;?>
'"> <div class="image">
										<?php if ($_smarty_tpl->tpl_vars['ac2']->value->image) {?>
											<img alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ac2']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ac2']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" src="<?php echo $_smarty_tpl->tpl_vars['config']->value->services_categories_images_dir;
echo $_smarty_tpl->tpl_vars['ac2']->value->image;?>
" />
										<?php } else { ?>
											<svg class="nophoto"><use xlink:href='#folder' /></svg>
										<?php }?>
									</div> <div class="product_info"> <h3><?php echo $_smarty_tpl->tpl_vars['ac2']->value->menu;?>
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
/*/ smarty_template_function_services_categories_tree2_13331096465fa00510850ee5_11608847 */
}
