<?php
/* Smarty version 3.1.33, created on 2020-11-02 20:03:43
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/articles.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fa0661fd7f1d9_45254085',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c92a9ad8fb65ec12c9639360e257e32fc8f5b5a5' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/articles.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fa0661fd7f1d9_45254085 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'articles_categories_tree2' => 
  array (
    'compiled_filepath' => '/Applications/MAMP/htdocs/zolotomania/compiled/mobile_mod/c92a9ad8fb65ec12c9639360e257e32fc8f5b5a5_0.file.articles.tpl.php',
    'uid' => 'c92a9ad8fb65ec12c9639360e257e32fc8f5b5a5',
    'call_name' => 'smarty_template_function_articles_categories_tree2_2757472375fa0661fc1f2c9_07253472',
  ),
));
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {?>
    <?php $_smarty_tpl->_assignInScope('wrapper', '' ,false ,8);?>
    	
	<input class="refresh_title" type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true);
if (!empty($_smarty_tpl->tpl_vars['current_page_num']->value) && $_smarty_tpl->tpl_vars['current_page_num']->value > 1) {?> - страница <?php echo $_smarty_tpl->tpl_vars['current_page_num']->value;
}?>" />
<?php }?>

<?php if (!empty($_smarty_tpl->tpl_vars['keyword']->value)) {?>
	<?php ob_start();
echo htmlspecialchars($_smarty_tpl->tpl_vars['keyword']->value, ENT_QUOTES, 'UTF-8', true);
$_prefixVariable1=ob_get_clean();
$_smarty_tpl->_assignInScope('canonical', "/articles?keyword=".$_prefixVariable1 ,false ,8);
} elseif (!empty($_smarty_tpl->tpl_vars['category']->value)) {?>
	<?php ob_start();
if ($_smarty_tpl->tpl_vars['current_page_num']->value > 1) {
echo "?page=";
echo (string)$_smarty_tpl->tpl_vars['current_page_num']->value;
}
$_prefixVariable2=ob_get_clean();
$_smarty_tpl->_assignInScope('canonical', "/articles/".((string)$_smarty_tpl->tpl_vars['category']->value->url).$_prefixVariable2 ,false ,8);
} else { ?>
	<?php ob_start();
if ($_smarty_tpl->tpl_vars['current_page_num']->value > 1) {
echo "?page=";
echo (string)$_smarty_tpl->tpl_vars['current_page_num']->value;
}
$_prefixVariable3=ob_get_clean();
$_smarty_tpl->_assignInScope('canonical', "/articles".$_prefixVariable3 ,false ,8);
}?>

<input class="curr_page" type="hidden" data-url="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['current_page_num']->value),$_smarty_tpl ) );?>
" value="<?php echo $_smarty_tpl->tpl_vars['current_page_num']->value;?>
" /> <input class="refresh_curr_page" type="hidden" data-url="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['current_page_num']->value),$_smarty_tpl ) );?>
" value="<?php echo $_smarty_tpl->tpl_vars['current_page_num']->value;?>
" />
<?php if ($_smarty_tpl->tpl_vars['current_page_num']->value < $_smarty_tpl->tpl_vars['total_pages_num']->value) {?><input class="refresh_next_page" type="hidden" data-url="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['current_page_num']->value+1),$_smarty_tpl ) );?>
" value="<?php echo $_smarty_tpl->tpl_vars['current_page_num']->value+1;?>
" /><?php }
if ($_smarty_tpl->tpl_vars['current_page_num']->value == 2) {?><input class="refresh_prev_page" type="hidden" data-url="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>null),$_smarty_tpl ) );?>
" value="<?php echo $_smarty_tpl->tpl_vars['current_page_num']->value-1;?>
" /><?php }
if ($_smarty_tpl->tpl_vars['current_page_num']->value > 2) {?><input class="refresh_prev_page" type="hidden" data-url="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['current_page_num']->value-1),$_smarty_tpl ) );?>
" value="<?php echo $_smarty_tpl->tpl_vars['current_page_num']->value-1;?>
" /><?php }?>
<input class="total_pages" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['total_pages_num']->value;?>
" />

<?php if ($_smarty_tpl->tpl_vars['page']->value && $_smarty_tpl->tpl_vars['page']->value->url == 'articles') {?>
	
	<?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'articles_categories_tree2', array('articles_categories'=>$_smarty_tpl->tpl_vars['articles_categories']->value), true);?>

<?php } else { ?>
	<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->subcategories)) {?>
		<ul class="category_products separator">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category']->value->subcategories, 'c', false, NULL, 'cats', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
				<?php if ($_smarty_tpl->tpl_vars['c']->value->visible) {?>
					<li class="product" onClick="window.location='articles/<?php echo $_smarty_tpl->tpl_vars['c']->value->url;?>
'"> <div class="image">
						<?php if (!empty($_smarty_tpl->tpl_vars['c']->value->image)) {?>
							<img alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" src="<?php echo $_smarty_tpl->tpl_vars['config']->value->articles_categories_images_dir;
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
		</ul>
	<?php }?>

<?php }?>

<?php if (!empty($_smarty_tpl->tpl_vars['page']->value->body) || !empty($_smarty_tpl->tpl_vars['category']->value->description)) {?>
	<div class="blog-pg">	
		<?php if (!empty($_smarty_tpl->tpl_vars['page']->value->body)) {
echo $_smarty_tpl->tpl_vars['page']->value->body;
}?>
		<?php if (!empty($_smarty_tpl->tpl_vars['category']->value->description) && $_smarty_tpl->tpl_vars['current_page_num']->value == 1) {?>
			<?php echo $_smarty_tpl->tpl_vars['category']->value->description;?>

		<?php }?>
	</div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['posts']->value) {?>
	<div class="ajax_pagination">

		
			
		<?php if ($_smarty_tpl->tpl_vars['current_page_num']->value >= 2) {?>
			<div class="infinite_prev" style="display:none;"> <div class="trigger_prev infinite_button">Загрузить пред. страницу</div> </div>
		<?php }?>

		<ul class="comment_list infinite_load" style="margin-top:0;">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>
			<li> <h3 class="blog_title"><?php if (!empty($_smarty_tpl->tpl_vars['post']->value->text)) {?><a data-article="<?php echo $_smarty_tpl->tpl_vars['post']->value->id;?>
" href="article/<?php echo $_smarty_tpl->tpl_vars['post']->value->url;?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->name, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a><?php } else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->name, ENT_QUOTES, 'UTF-8', true);
}?></h3> <div class="postdate dateico"> <div class="left"> <svg><use xlink:href='#calendar' /></svg> <span><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value->date ));?>
</span> </div> <div class="right"> <svg><use xlink:href='#views' /></svg> <span>Просмотров: <?php echo $_smarty_tpl->tpl_vars['post']->value->views;?>
</span> </div> </div>
				<?php if (!empty($_smarty_tpl->tpl_vars['post']->value->annotation)) {?><div class="post-annotation"><?php echo $_smarty_tpl->tpl_vars['post']->value->annotation;?>
</div><?php }?>
								<?php if (!empty($_smarty_tpl->tpl_vars['post']->value->section)) {?>
					<div class="path"> <svg><use xlink:href='#folder' /></svg> <a href="articles/<?php echo $_smarty_tpl->tpl_vars['post']->value->section->url;?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->section->name, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->section->name, ENT_QUOTES, 'UTF-8', true);?>
</a> </div>
				<?php }?>		
			</li>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</ul>

				<?php if ($_smarty_tpl->tpl_vars['total_pages_num']->value > 1) {?>
			<div class="infinite_pages infinite_button" style="display:none;margin:15px auto;"> <div>Стр. <?php echo $_smarty_tpl->tpl_vars['current_page_num']->value;?>
 из <?php echo $_smarty_tpl->tpl_vars['total_pages_num']->value;?>
</div> </div> <div class="infinite_trigger"></div>
		<?php }?>

	</div>
<?php } else { ?>
	<?php if (isset($_smarty_tpl->tpl_vars['keyword']->value) && empty($_smarty_tpl->tpl_vars['posts']->value)) {?><div class="blog-pg">Статьи не найдены</div><?php }
}?>	
<?php }
/* smarty_template_function_articles_categories_tree2_2757472375fa0661fc1f2c9_07253472 */
if (!function_exists('smarty_template_function_articles_categories_tree2_2757472375fa0661fc1f2c9_07253472')) {
function smarty_template_function_articles_categories_tree2_2757472375fa0661fc1f2c9_07253472(Smarty_Internal_Template $_smarty_tpl,$params) {
$params = array_merge(array('level'=>1), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

			<?php if ($_smarty_tpl->tpl_vars['articles_categories']->value) {?>
				<ul class="category_products separator">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['articles_categories']->value, 'ac2');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['ac2']->value) {
?>
						<?php if ($_smarty_tpl->tpl_vars['ac2']->value->visible) {?>
							<li class="product" onClick="window.location='articles/<?php echo $_smarty_tpl->tpl_vars['ac2']->value->url;?>
'"> <div class="image">
								<?php if ($_smarty_tpl->tpl_vars['ac2']->value->image) {?>
									<img alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ac2']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ac2']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" src="<?php echo $_smarty_tpl->tpl_vars['config']->value->articles_categories_images_dir;
echo $_smarty_tpl->tpl_vars['ac2']->value->image;?>
" />
								<?php } else { ?>
									<svg class="nophoto"><use xlink:href='#folder' /></svg>
								<?php }?>
								</div> <div class="product_info"> <h3><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ac2']->value->name, ENT_QUOTES, 'UTF-8', true);?>
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
/*/ smarty_template_function_articles_categories_tree2_2757472375fa0661fc1f2c9_07253472 */
}
