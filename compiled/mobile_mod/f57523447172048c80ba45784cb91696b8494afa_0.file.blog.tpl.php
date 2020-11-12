<?php
/* Smarty version 3.1.33, created on 2020-11-02 19:55:21
  from '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/blog.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5fa064295133b8_13035030',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f57523447172048c80ba45784cb91696b8494afa' => 
    array (
      0 => '/Applications/MAMP/htdocs/zolotomania/design/mobile_mod/html/blog.tpl',
      1 => 1604315638,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fa064295133b8_13035030 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/Applications/MAMP/htdocs/zolotomania/Smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {?>
    <?php $_smarty_tpl->_assignInScope('wrapper', '' ,false ,8);?>
    	
	<input class="refresh_title" type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true);
if (!empty($_smarty_tpl->tpl_vars['current_page_num']->value) && $_smarty_tpl->tpl_vars['current_page_num']->value > 1) {?> - страница <?php echo $_smarty_tpl->tpl_vars['current_page_num']->value;
}?>" />
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['keyword']->value)) {?>
	<?php ob_start();
echo htmlspecialchars($_smarty_tpl->tpl_vars['keyword']->value, ENT_QUOTES, 'UTF-8', true);
$_prefixVariable1=ob_get_clean();
$_smarty_tpl->_assignInScope('canonical', "/blog?keyword=".$_prefixVariable1 ,false ,8);
} elseif (isset($_smarty_tpl->tpl_vars['category']->value)) {?>
	<?php ob_start();
if ($_smarty_tpl->tpl_vars['current_page_num']->value > 1) {
echo "?page=";
echo (string)$_smarty_tpl->tpl_vars['current_page_num']->value;
}
$_prefixVariable2=ob_get_clean();
$_smarty_tpl->_assignInScope('canonical', "/sections/".((string)$_smarty_tpl->tpl_vars['category']->value->url).$_prefixVariable2 ,false ,8);
} else { ?>
	<?php ob_start();
if ($_smarty_tpl->tpl_vars['current_page_num']->value > 1) {
echo "?page=";
echo (string)$_smarty_tpl->tpl_vars['current_page_num']->value;
}
$_prefixVariable3=ob_get_clean();
$_smarty_tpl->_assignInScope('canonical', "/blog".$_prefixVariable3 ,false ,8);
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

<?php if (empty($_smarty_tpl->tpl_vars['category']->value) && !empty($_smarty_tpl->tpl_vars['blog_categories']->value)) {?>
	<div class="brand-pg"> <ul class="category_products brands_list">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['blog_categories']->value, 'bc');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['bc']->value) {
?>
			<?php if ($_smarty_tpl->tpl_vars['bc']->value->visible) {?>
			<li class="product" style="cursor:pointer;" onClick="window.location='/sections/<?php echo $_smarty_tpl->tpl_vars['bc']->value->url;?>
'"> <div class="image">
					<?php if ($_smarty_tpl->tpl_vars['bc']->value->image) {?>
						<img alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['bc']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['bc']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" src="<?php echo $_smarty_tpl->tpl_vars['config']->value->blog_categories_images_dir;
echo $_smarty_tpl->tpl_vars['bc']->value->image;?>
" />
					<?php } else { ?>
						<svg class="nophoto"><use xlink:href='#folder' /></svg>
					<?php }?>
				</div> <div class="product_info"> <h3><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['bc']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</h3> </div> </li>
			<?php }?>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul> </div>	
<?php }?>

<?php if (!empty($_smarty_tpl->tpl_vars['page']->value->body)) {?>
	<div class="post-pg">
		<?php echo $_smarty_tpl->tpl_vars['page']->value->body;?>

	</div>
<?php }?>

<?php if (!empty($_smarty_tpl->tpl_vars['posts']->value)) {?>
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
			<li> <h3 class="blog_title"><?php if (!empty($_smarty_tpl->tpl_vars['post']->value->text)) {?><a data-post="<?php echo $_smarty_tpl->tpl_vars['post']->value->id;?>
" href="blog/<?php echo $_smarty_tpl->tpl_vars['post']->value->url;?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->name, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a><?php } else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value->name, ENT_QUOTES, 'UTF-8', true);
}?></h3> <div class="postdate dateico"> <div class="left"> <svg><use xlink:href='#calendar' /></svg> <span><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value->date ));?>
</span> </div> <div class="right"> <svg class="comments_icon"><use xlink:href='#comments_count' /></svg> <span><?php echo $_smarty_tpl->tpl_vars['post']->value->comments_count;?>
</span> </div> <div class="right"> <svg><use xlink:href='#views' /></svg> <span>Просмотров: <?php echo $_smarty_tpl->tpl_vars['post']->value->views;?>
</span> </div> </div>
				<?php if (!empty($_smarty_tpl->tpl_vars['post']->value->annotation)) {?><div class="post-annotation"><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['post']->value->annotation,"li>","div>");?>
</div><?php }?>
								<?php if (isset($_smarty_tpl->tpl_vars['post']->value->section)) {?>
				<div class="path"> <svg><use xlink:href='#folder' /></svg> <a href="sections/<?php echo $_smarty_tpl->tpl_vars['post']->value->section->url;?>
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
	<div class="post-pg">
		Публикаций не найдено
	</div>
<?php }
}
}
